<?php

namespace Modules\Committee\Entities;

use App\Classes\Date\CarbonHijri;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;

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
        'resource_staff_number', 'resource_at', 'resource_by', 'treatment_number', 'treatment_time', 'treatment_type_id',
        'treatment_urgency_id', 'treatment_importance_id', 'source_of_study_id', 'recommendation_number', 'recommended_by_id',
        'recommended_at', 'subject', 'first_meeting_at', 'tasks', 'president_id', 'advisor_id', 'members_count', 'status',
        'reason_of_deletion',
    ];

    protected $appends = [
        'resource_at_hijri', 'created_at_hijri', 'first_meeting_at_hijri', 'recommended_at_hijri'
    ];

    protected $dates = [
        'resource_at', 'treatment_time', 'first_meeting_at', 'recommended_at'
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

    public function setTreatmentTimeAttribute($value)
    {
        $this->attributes['treatment_time'] = self::getDateFromFormat($value);
    }

    public function setFirstMeetingAtAttribute($value)
    {
        $this->attributes['first_meeting_at'] = self::getDateFromFormat($value);
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

    /**
     * Scopes
     *
     * Here Scopes
     */
    public function scopeSearch($query, $request)
    {

        // Filter By Request
        if ($request->has('subject')) {
            $query->where('subject', 'LIKE', '%' . $request->subject . '%');
        }
        if ($request->has('advisor_id') && $request->advisor_id != 0) {
            $query->where('advisor_id', $request->advisor_id);
        }
        if ($request->has('status') && $request->status != '0') {
            $query->where('status', $request->status);
        }
        if ($request->has('treatment_number')) {
            $query->where('treatment_number', $request->treatment_number);
        }
        if ($request->has('treatment_time')) {
            $query->whereDate('treatment_time', '=', Carbon::createFromFormat('m/d/Y', $request->treatment_time));
        }
        if ($request->has('uuid')) {
            $query->where('uuid', $request->uuid);
        }
        if ($request->has('created_at')) {
            $query->whereDate('created_at', '=', Carbon::createFromFormat('m/d/Y', $request->created_at));
        }
        if (auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            // Secretary Should see Committees for his Advisors Only
            $advisorsId = auth()->user()->advisors()->pluck('users.id');
            $query->whereIn('advisor_id', $advisorsId);
        } elseif (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            // Advisors Should see Committees he owns or where he is a participant
            $owns = auth()->user()->ownedCommittees()->pluck('committees.id')->toArray();
            $participantIn = auth()->user()->participantInCommittees()->pluck('committees.id')->toArray();
            $query->whereIn('id', array_merge($owns, $participantIn));
        } elseif (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            $childrenDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
            $departmentsId = array_merge($childrenDepartments, [auth()->user()->parent_department_id]);
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
                [
                    'status' => self::WAITING_DELEGATES,
                ]
            )
        );
        $committee->participantAdvisors()->attach($request->participant_advisors[0] != null ? $request->participant_advisors : []);
        $committee->participantDepartments()->sync($request->departments);
        $committee->update(['members_count' => $committee->participantAdvisors()->count()]);
        CommitteeDocument::updateDocumentsCommittee($committee->id);
        event(new CommitteeCreatedEvent($committee));
        return $committee;
    }

    public function updateFromRequest($request)
    {
        $this->update($request->all());
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

    public function resourceDepartment()
    {
        return $this->belongsTo(Department::class, 'resource_by');
    }

    public function recommendedByDepartment()
    {
        return $this->belongsTo(Department::class, 'recommended_by_id');
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

    public function getNominationDepartmentsWithRef()
    {
        if (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            $childrenDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
            $departmentsId = array_merge($childrenDepartments, [auth()->user()->parent_department_id]);

            return $this->nominationDepartments()->whereIn('department_id', $departmentsId)->with('referenceDepartment')->get();
        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            $parentDepartmentId = auth()->user()->parentDepartment->id;
            return $this->nominationDepartments()->where('department_id', $parentDepartmentId)->with('referenceDepartment')->get();

        }

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
            ->withTimestamps();
    }
}
