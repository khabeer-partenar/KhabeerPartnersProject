<?php

namespace Modules\Committee\Entities;

use App\Classes\Date\CarbonHijri;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Core\Entities\Group;
use Modules\Core\Entities\Status;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;
use Modules\Committee\Events\NominationDoneEvent;

class Committee extends Model
{
    use SharedModel, Log, SoftDeletes;

    const WAITING_DELEGATES = 'waiting_for_delegates';
    const NOMINATIONS_COMPLETED = 'nominations_completed';
    const HOLD = 'hold';
    const WAITING_SIGNATURE = 'waiting_for_signature';
    const SIGNATURE_COMPLETED = 'signature_completed';
    const STATUS = [
        self::WAITING_DELEGATES => 'Waiting for Delegates',
        self::NOMINATIONS_COMPLETED => 'Nominations Completed',
        self::HOLD => 'Hold',
        self::WAITING_SIGNATURE => 'Waiting for Signature',
        self::SIGNATURE_COMPLETED => 'Signature Completed',
    ];

    protected $fillable = [
        'resource_staff_number', 'resource_at', 'department_out_number', 'department_out_date', 'resource_by', 'treatment_number', 'treatment_time', 'treatment_type_id',
        'treatment_urgency_id', 'treatment_importance_id', 'source_of_study_id', 'recommendation_number', 'recommended_by_id',
        'recommended_at', 'subject', 'first_meeting_at', 'tasks', 'president_id', 'advisor_id', 'members_count', 'status',
        'reason_of_deletion', 'created_by', 'approved', 'exported'
    ];

    protected $appends = [
        'resource_at_hijri', 'created_at_hijri', 'first_meeting_at_hijri', 'first_meeting_time', 'recommended_at_hijri'
    ];

    protected $dates = [
        'resource_at', 'department_out_date', 'treatment_time', 'first_meeting_at', 'recommended_at'
    ];

    /**
     * Accessors and Mutators
     *
     * Here goes Acc. and Mut.
     */
    public function setResourceAtAttribute($value)
    {
        $this->attributes['resource_at'] = self::getDateFromFormat($value);
    }

    public function setDepartmentOutDateAttribute($value)
    {
        $this->attributes['department_out_date'] = self::getDateFromFormat($value);
    }

    public function setTreatmentTimeAttribute($value)
    {
        $this->attributes['treatment_time'] = self::getDateFromFormat($value);
    }

    public function setFirstMeetingAtAttribute($value)
    {
        $this->attributes['first_meeting_at'] = self::getDateFromFormat($value, 'd/m/Y H:i');
    }

    public function setRecommendedAtAttribute($value)
    {
        $this->attributes['recommended_at'] = self::getDateFromFormat($value);
    }

    public function getResourceAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['resource_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getDepartmentOutDateHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['department_out_date'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getRecommendedAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['recommended_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getfirstMeetingAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['first_meeting_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getCreatedAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getFirstMeetingTimeAttribute()
    {
        $time = Carbon::parse($this->attributes['first_meeting_at'])->format('h:i A');
        if (strpos($time, ' AM')) {
            return str_replace('AM', __('committee::committees.am'), $time);
        } else {
            return str_replace('PM', __('committee::committees.pm'), $time);
        }

    }

    public function getGroupStatusAttribute()
    {
        $group_id = auth()->user()->job_role_id;
        $groupStatus = $this->groupStatus($group_id)->first();
        if ($groupStatus == null) {
            // default if the user group dose not exist
            $group_id = Group::where('key', Employee::SECRETARY)->first()->id;
            $groupStatus = $this->groupStatus($group_id)->first()->status()->first()->status_ar;

        } else {
            $groupStatus = $this->groupStatus($group_id)->first()->status()->first()->status_ar;
        }
        return $groupStatus;
    }

    public function getCanTakeActionAttribute()
    {
        return in_array(auth()->user()->id, [$this->created_by, $this->advisor_id]);
    }

    /**
     * Scopes
     *
     * Here Scopes
     */
    public function scopeSearch($query, $request)
    {
        // Filter By Request
        if ($request->subject) {
            $query->where('subject', 'LIKE', '%' . $request->subject . '%');
        }
        if ($request->advisor_id && $request->advisor_id != 0) {
            $query->where('advisor_id', $request->advisor_id);
        }
        if ($request->status && $request->status != '0') {
            $query->where('status', $request->status);
        }
        if ($request->treatment_number) {
            $query->where('treatment_number', $request->treatment_number);
        }
        if ($request->treatment_time && $request->treatment_time != '') {
            $query->whereDate('treatment_time', '=', Carbon::createFromFormat('m/d/Y', $request->treatment_time));
        }
        if ($request->uuid) {
            $query->where('uuid', $request->uuid);
        }
        if ($request->created_at) {
            $query->whereDate('created_at', '=', Carbon::createFromFormat('m/d/Y', $request->created_at));
        }

        return $query;
    }

    public function scopeUser($query)
    {

        if(!in_array(auth()->user()->authorizedApps->key, [Employee::ADVISOR, Employee::SECRETARY]) && !auth()->user()->is_super_admin) {
            $query->where('approved', true);
        }

        if(auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            $query->whereRaw('IF(advisor_id <> ?, approved=?, advisor_id=advisor_id)', [auth()->user()->id, true]);
        }

        if (auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            // Secretary Should see Committees for his Advisors Only
            $advisorsId = auth()->user()->advisors()->pluck('users.id');
            $query->whereIn('advisor_id', $advisorsId);
        } elseif (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            // Advisors Should see Committees he owns or where he is a participant
            $participantIn = auth()->user()->participantInCommittees()->pluck('committees.id')->toArray();
            $query->whereIn('id', $participantIn)
                ->orWhere(function ($query) {
                    $query->where('advisor_id', auth()->id());
                });
        } elseif (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            $departmentsId = auth()->user()->coordinatorAuthorizedIds();
            $committeeIds = CommitteeDepartment::whereIn('department_id', $departmentsId)->pluck('committee_id');
            $query->whereIn('id', $committeeIds);
        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            $parentDepartmentId = auth()->user()->parentDepartment->pluck('id');
            $committeeIds = CommitteeDepartment::whereIn('department_id', $parentDepartmentId)->pluck('committee_id');
            $query->whereIn('id', $committeeIds);
        } elseif (auth()->user()->authorizedApps->key == Delegate::JOB) {
            $delegate = Delegate::find(auth()->user()->id);
            $committeeIds = $delegate->committees()->pluck('committee_id');
            $query->whereIn('id', $committeeIds);

        }

        return $query;
    }

    public function scopeCheckIfCommitteeDepartmentsHasDelegates()
    {
        $committeeDepartments = $this->departments;
        $committeeDelegatesDepartments = $this->committeeDelegates;
        if ($committeeDepartments->count() == $committeeDelegatesDepartments->count()) {
            CommitteeStatus::updateCommitteeGroupsStatusToNominationsCompleted($this,Status::NOMINATIONS_COMPLETED);
        } else {
            CommitteeStatus::updateCommitteeGroupsStatusToNominationsCompleted($this,Status::WAITING_DELEGATES);
        }
    }

    public function scopeExported($query, $status = true)
    {
        return $query->where('exported', $status);
    }

    /**
     * Functions
     */
    public function getDelegatesWithDetails()
    {
        return $this->delegates()->with(['department' => function ($query) {
            $query->with('referenceDepartment');
        }])->get();
    }

    public static function getDateFromFormat($value, $format = 'm/d/Y')
    {
        try {
            return $date = Carbon::createFromFormat($format, $value);
        } catch (InvalidDateException $exception) {
            report($exception);
            return false;
        }
    }

    public static function createFromRequest($request)
    {
        $committee = self::query()->create(
            array_merge(
                $request->all(),
                ['status' => self::WAITING_DELEGATES, 'created_by' => auth()->id()]
            )
        );
        $committee->participantAdvisors()->attach($request->participant_advisors[0] != null ? $request->participant_advisors : []);
        $committee->participantDepartments()->sync($request->departments);
        $committee->update(['members_count' => $committee->participantAdvisors()->count()]);
        $committee->updateDocuments();

        $type = MeetingType::where('slug', MeetingType::PRIMARY)->first();
        Meeting::create([
            'committee_id' => $committee->id,
            'type_id' => $type->id,
            'from' => self::getDateFromFormat($request->first_meeting_at,'d/m/Y H:i'),
            'advisor_id' => $request->advisor_id
        ]);

        event(new CommitteeCreatedEvent($committee));
        return $committee;
    }

    public function updateFromRequest($request)
    {
        $this->update($request->except('first_meeting_at'));
        $this->participantAdvisors()->sync($request->participant_advisors[0] != null ? $request->participant_advisors : []);
        $this->participantDepartments()->sync($request->departments);
        $this->update(['members_count' => $this->participantAdvisors()->count()]);
        return $this;
    }

    public function participantDepartmentsWithRef()
    {
        return $this->participantDepartments()->with('referenceDepartment')->get();
    }

    public function participantDepartmentsUsersUnique()
    {
        $toBeNotifiedUsers = [];
        foreach ($this->participantDepartmentsWithRef() as $department) {
            $users = $department->users('parent')->get();
            $toBeNotifiedUsers = array_merge($toBeNotifiedUsers, Arr::flatten($users));
            if ($department->referenceDepartment) {
                $refUsers = $department->referenceDepartment->users('parent')->get();
                $toBeNotifiedUsers = array_merge($toBeNotifiedUsers, Arr::flatten($refUsers));
            }
        }
        return $toBeNotifiedUsers;
    }

    public function updateDocuments()
    {
        $documents = CommitteeDocument::where('user_id', auth()->id())->whereNull('committee_id')->get();
        foreach ($documents as $document) {
            $fileName = basename($document->path);
            $newPath = "committees/$this->id/$fileName";
            $moved = Storage::move($document->path, $newPath);
            if ($moved) {
                $document->update(['committee_id' => $this->id, 'path' => $newPath]);
            }
        }
    }

    public function filterIfDepartmentHasNominations()
    {
        foreach($this->getNominationDepartmentsWithRef() as $department)
        {
           return $department->pivot->has_nominations==1?__('committee::committees.nomination_done'):__('committee::committees.nomination_not_done'); 
        }
        
    }

    public function groupsStatuses()
    {
        return $this->belongsToMany(Group::class, 'committee_group_status', 'committee_id', 'group_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function getNominationDepartmentsWithRef()
    {
        if (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            $childrenDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
            $departmentsId = array_merge($childrenDepartments, [auth()->user()->parent_department_id]);
            return $this->nominationDepartments()->whereIn('department_id', $departmentsId)->with('referenceDepartment')->get();
        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            $parentDepartmentId = auth()->user()->parentDepartment->id;
            return $this->nominationDepartments()->where('department_id', $parentDepartmentId)->with('referenceDepartment')->get();

        } elseif (auth()->user()->is_super_admin) {

        }

    }

    public function groupStatus($groupId)
    {
        return $this->hasMany(CommitteeGroupStatus::class, 'committee_id')
            ->with('status')->where('group_id', $groupId);
    }

    public function setView()
    {
        return $this->view == null ? $this->views()->create(['user_id' => auth()->id()]):null;
    }

    public function updateFirstMeetingAt()
    {
        $nearestMeeting = $this->meetings()->orderBy('from', 'asc')->first();
        $formatted = Carbon::parse($nearestMeeting->from_date)->format('d/m/Y H:i');
        return $this->update(['first_meeting_at' => $formatted]);
    }

    /**
     * Relations
     *
     * Here goes relations
     */
    public function treatmentUrgency()
    {
        return $this->belongsTo(TreatmentUrgency::class, 'treatment_urgency_id');
    }

    public function treatmentType()
    {
        return $this->belongsTo(TreatmentType::class, 'treatment_type_id');
    }

    public function treatmentImportance()
    {
        return $this->belongsTo(TreatmentImportance::class, 'treatment_importance_id');
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }

    public function documents()
    {
        return $this->hasMany(CommitteeDocument::class, 'committee_id');
    }

    public function departments()
    {
        return $this->hasMany(CommitteeDepartment::class, 'committee_id');
    }

    public function committeeDelegates()
    {
        return $this->hasMany(CommitteeDelegate::class, 'committee_id');
    }

    public function resourceDepartment()
    {
        return $this->belongsTo(Department::class, 'resource_by');
    }

    public function recommendedByDepartment()
    {
        return $this->belongsTo(Department::class, 'recommended_by_id');
    }

    public function sourceOfStudy()
    {
        return $this->belongsTo(Department::class, 'source_of_study_id');
    }

    public function participantAdvisors()
    {
        return $this->belongsToMany(User::class, 'committees_participant_advisors', 'committee_id', 'advisor_id')->withTimestamps();
    }

    public function participantDepartments()
    {
        return $this->belongsToMany(Department::class, 'committees_participant_departments', 'committee_id', 'department_id')
            ->withTimestamps()
            ->withPivot('nomination_criteria');
    }

    public function view()
    {
        return $this->hasOne(CommitteeView::class, 'committee_id')->where('user_id', auth()->id());
    }

    public function views()
    {
        return $this->hasMany(CommitteeView::class, 'committee_id');
    }

    public function nominationDepartments()
    {
        return $this->belongsToMany(Department::class, 'committees_participant_departments', 'committee_id', 'department_id')
            ->withPivot('nomination_criteria', 'has_nominations');
    }

    public function delegates()
    {
        return $this->belongsToMany(Delegate::class, 'committee_delegate', 'committee_id', 'user_id')
            ->withPivot('nominated_department_id')
            ->whereNull('committee_delegate.deleted_at')
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function multimedia()
    {
        return $this->hasMany(Multimedia::class, 'committee_id');
    }
}
