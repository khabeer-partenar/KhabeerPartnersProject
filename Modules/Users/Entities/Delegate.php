<?php


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDelegate;
use Modules\Committee\Entities\CommitteeStatus;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Entities\Multimedia;
use Modules\Core\Entities\Status;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Committee\Entities\MeetingDriver;
use Modules\Users\Events\DelegateCreatedEvent;
use Modules\Users\Notifications\NotifyDeletedDelegate;
use Notification;


class Delegate extends User
{
    use SharedModel, Log, SoftDeletes;
    const TYPE = 'delegate';
    const JOB = 'delegate';


    /**
     * add global scope
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('filterUserType', function (Builder $builder) {
            $builder->where('user_type', self::TYPE);
        });
    }

    public static function checkIfNominationCompleted($committee_id)
    {
        $committee = Committee::find($committee_id);
        $nominationDepartmentsIds = $committee->getNominationDepartmentsWithRef()->pluck('id');
        $committeeNominationDepartments = CommitteeDelegate::whereIn('nominated_department_id', $nominationDepartmentsIds)->distinct()->pluck('nominated_department_id');
        if ($nominationDepartmentsIds->count() == $committeeNominationDepartments->count()) {
            return true;
        }
        return false;
    }

    public static function updateCommitteeGroupsStatusToNominationsCompleted($committee_id)
    {
        $committee = Committee::find($committee_id);
        $nominationDepartmentsIds = $committee->nominationDepartments()->pluck('department_id');

        $committeeNominatedDepartments = CommitteeDelegate::whereIn('nominated_department_id', $nominationDepartmentsIds)->distinct()->pluck('nominated_department_id');

        if ($nominationDepartmentsIds->count() == $committeeNominatedDepartments->count()) {
            CommitteeStatus::updateCommitteeGroupsStatusToNominationsCompleted($committee,Status::NOMINATIONS_COMPLETED);
        }

    }
    public function setCommitteeNominationStatus($committee_id)
    {
        $committee = Committee::find($committee_id);
        $nominationDepartmentsIds = $committee->nominationDepartments()->pluck('department_id');
        $coordinatorsNominationDepartmentsIds = $committee->getNominationDepartmentsWithRef()->pluck('id');

        $committeeNominatedDepartments = CommitteeDelegate::whereIn('nominated_department_id', $nominationDepartmentsIds)->distinct()->pluck('nominated_department_id');

        if (!$nominationDepartmentsIds->count() == $committeeNominatedDepartments->count()) {
            CommitteeStatus::updateCommitteeGroupsStatusToNominationsCompleted($committee,Status::WAITING_DELEGATES);
        }

    }

    public function addDelegatesToCommittee(Request $request)
    {
        $committee = Committee::where('id', $request->committee_id)->firstOrFail();
        $committee->delegates()->attach($request->delegates_ids, ['nominated_department_id' => $request->department_id,'coordinator_id' => auth()->user()->id]);

        $department = $committee->nominationDepartments()->where('department_id', $request->department_id)->firstOrFail();
        $department->pivot->has_nominations = 1;
        $department->pivot->save();

        $this->setCommitteeNominationStatus($request->committee_id);
        $committee->setMembersCount();
        $this->sendNotificationToNominatedDelegates($request->delegates_ids, $committee);
    }

    public function sendNotificationToNominatedDelegates($delegates, $committee)
    {
        foreach ($delegates as $delegate_id) {
            $delegate = Delegate::find($delegate_id);
            event(new DelegateCreatedEvent($delegate, $committee));
        }

    }

    public function removeDelegateFromCommittee(Delegate $delegate, $committee_id, $department_id, $reason,$forever=false)
    {
        if ($forever)
        {
            CommitteeDelegate::where('user_id', $delegate->id)
                ->where('nominated_department_id', $department_id)
                ->where('committee_id', $committee_id)->forceDelete();
        }
        else {
            CommitteeDelegate::where('user_id', $delegate->id)
                ->where('nominated_department_id', $department_id)
                ->where('committee_id', $committee_id)->delete();
        }
        $committee = Committee::find($committee_id)->with('delegates')->first();
        $delegatesCount = CommitteeDelegate::where('committee_id', $committee_id)
            ->where('nominated_department_id', $department_id)->get()->count();
        if ($delegatesCount == 0) {
            $committee = Committee::where('id', $committee_id)->with('nominationDepartments')->first();
            $department = $committee->nominationDepartments->find($department_id);
            $department->pivot->has_nominations = 0;
            $department->pivot->save();
        }
        $this->setCommitteeNominationStatus($committee_id);
        $advisor = $committee->advisor;
        $committee->setMembersCount();
        Notification::send([$advisor,$advisor->secretaries,$delegate], new NotifyDeletedDelegate($delegate, $committee, $reason));
    }

    public function addDelegateToCommittee(Request $request, int $delegate_id)
    {
        $committee = Committee::findOrFail($request->committee_id)->with('delegates')->first();
        $committee->delegates()->attach($delegate_id, array('nominated_department_id' => $request->parent_department_id
            ,'coordinator_id' => auth()->user()->id));

        $department = $committee->nominationDepartments()->where('department_id', $request->department_id)->firstOrFail();
        $department->pivot->has_nominations = 1;
        $department->pivot->save();

        $this->setCommitteeNominationStatus($committee->id);
        $committee->setMembersCount();
        $delegate = Delegate::find($delegate_id);
        event(new DelegateCreatedEvent($delegate, $committee));

    }

    public function scopeNotInCommittee($query, $department_id, $committee_id)
    {
        return $query->with('committees')->wherePivot('nominated_department_id', $department_id);
    }


    public static function getDepartmentDelegatesNotInCommitteeIds($department_id, $committee_id)
    {
        $department = Department::find($department_id);
        if ($department->is_reference) {
            $delegatesQuery = Delegate::with('department')
                ->where('parent_department_id', $department_id)
                ->whereDoesntHave('committees', function ($query) use ($department_id, $committee_id) {
                    $query->where("committee_delegate.nominated_department_id", '=', $department_id)
                        ->where("committee_delegate.committee_id", '=', $committee_id);
                })->pluck('id')->toArray();

        } else {

            $referenceDepartment = Department::with('referenceDepartment')->where('id', $department_id)
                ->first()->referenceDepartment;
            $refAndchildrenDepartments = $referenceDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
            array_push($refAndchildrenDepartments, $referenceDepartment->id);
            $delegatesQuery = Delegate::with(['department' => function ($query) {
                $query->with('referenceDepartment');
            }])
                ->WhereIn('parent_department_id', $refAndchildrenDepartments)
                ->whereDoesntHave('committees', function ($query) use ($department_id, $committee_id) {
                    $query->where("committee_delegate.nominated_department_id", '=', $department_id)
                        ->where("committee_delegate.committee_id", '=', $committee_id);
                })
                ->distinct()->pluck('id')->toArray();
        }

        return $delegatesQuery;
    }

    public static function getDepartmentDelegatesNotInCommittee($department_id, $committee_id)
    {
        $department = Department::find($department_id);
        if ($department->is_reference) {
            $delegatesQuery = Delegate::with('department')
                ->where('parent_department_id', $department_id)
                ->whereDoesntHave('committees', function ($query) use ($department_id, $committee_id) {
                    $query->where("committee_delegate.nominated_department_id", '=', $department_id)
                        ->where("committee_delegate.committee_id", '=', $committee_id);
                })->get();

        } else {

            $referenceDepartment = Department::with('referenceDepartment')->where('id', $department_id)
                ->first()->referenceDepartment;
            $refAndchildrenDepartments = $referenceDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
            if (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB)
            {
                array_push($refAndchildrenDepartments, $referenceDepartment->id);
            }
            $delegatesQuery = Delegate::with(['department' => function ($query) {
                $query->with('referenceDepartment');
            }])
                ->WhereIn('parent_department_id', $refAndchildrenDepartments)
                ->whereDoesntHave('committees', function ($query) use ($department_id, $committee_id) {
                    $query->where("committee_delegate.nominated_department_id", '=', $department_id)
                        ->where("committee_delegate.committee_id", '=', $committee_id);
                })
                ->distinct()->get();
        }
        $depart_id = collect();
        $depart_id->put('department_id', $department_id);
        return [$delegatesQuery, $depart_id];
    }

    /**
     * Functions
     *
     * Add Functions
     * @param $request
     * @return
     */
    public static function createFromRequest($request)
    {
        $delegate = self::create(
            array_merge(
                $request->only(
                    'direct_department', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
                    'specialty', 'main_department_id', 'parent_department_id', 'department_reference_id', 'job_role_id'
                ), ['user_type' => self::TYPE]
            )
        );
        $delegate->groups()->attach($delegate->job_role_id);

        return $delegate;
    }


    public function updateFromRequest($request)
    {
        $this->update(
            $request->only(
                'direct_department', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'specialty', 'title',
                'main_department_id', 'parent_department_id', 'job_role_id', 'department_reference_id'
            )
        );
        $this->groups()->sync($this->job_role_id);
        return $this;
    }

    /**
     * Scopes
     *
     * Here add Scopes
     * @param $query
     * @param Request $request
     */
    public static function scopeSearch($query, $request)
    {
        if (auth()->user()->user_type == Delegate::TYPE) {
            $delegatesIds = $query->where(function ($query) {
                $query->where('department_reference_id', auth()->user()->parent_department_id)
                    ->orWhere('parent_department_id', auth()->user()->parent_department_id);
            })->pluck('id');
        }
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('main_department_id') && $request->main_department_id != 0) {
            $query->where('main_department_id', $request->main_department_id);
        }
        if ($request->has('parent_department_id') && $request->parent_department_id != 0) {
            $query->where('parent_department_id', $request->parent_department_id);
        }
        if (isset($delegatesIds)) {
            $query->whereIn('id', $delegatesIds);
        }
        return $query;
    }

    public static function scopeUserDepartment($query)
    {
        if (auth()->user()->user_type == Coordinator::TYPE) {
            $department_id = auth()->user()->parent_department_id;
            return $query->where('parent_department_id', $department_id)
                ->orWhere('department_reference_id', $department_id);
        }
    }

    /**
     * Relations
     *
     * Here Add Relations
     */
    public function committees()
    {
        return $this->belongsToMany(Committee::class, 'committee_delegate', 'user_id', 'committee_id')
            ->withPivot('user_id', 'committee_id', 'nominated_department_id');
    }

    public function delegateCommittees()
    {
        return $this->hasMany(CommitteeDelegate::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    public function documents()
    {
        return $this->hasMany(MeetingDocument::class, 'user_id', 'id')->where('owner', 0);
    }

    public function attendingMeetings()
    {
        return $this->hasMany(MeetingDelegate::class, 'delegate_id')->where('status', MeetingDelegate::ACCEPTED);
    }

    public function multimedia()
    {
        return $this->hasMany(Multimedia::class, 'user_id');
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, MeetingDelegate::table(), 'delegate_id', 'meeting_id')
            ->withPivot('refuse_reason', 'status', 'attended');
    }

    public function driver()
    {
        return $this->hasMany(MeetingDriver::class);
    }

    public function checkIfDelegateInMeetings()
    {
        $delegates = MeetingDelegate::where('delegate_id',$this->id)
                        ->where('status',MeetingDelegate::ACCEPTED)->get();
        if ($delegates->count() > 0) return true;
        return false;
    }
}
