<?php


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDelegate;

use Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use DB;
use Modules\Users\Events\DelegateCreatedEvent;
use Modules\Users\Events\DelegateDeletedEvent;


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

    public function setCommitteeNominationStatus($committee_id)
    {
        $committee = Committee::find($committee_id);
        $nominationDepartmentsIds = $committee->getNominationDepartmentsWithRef()->pluck('id');
        $committeeNominationDepartments = CommitteeDelegate::whereIn('nominated_department_id', $nominationDepartmentsIds)->distinct()->pluck('nominated_department_id');
        if ($nominationDepartmentsIds->count() == $committeeNominationDepartments->count()) {
            $committee->status = Committee::NOMINATIONS_COMPLETED;
            $committee->save();
        } else {
            $committee->status = Committee::WAITING_DELEGATES;
            $committee->save();
        }
    }

    public function addDelegatesToCommittee(Request $request)
    {
        $committee = Committee::where('id', $request->committee_id)->first();
        $committee->delegates()->attach($request->delegates_ids, array('nominated_department_id' => $request->department_id));

        $committee = Committee::where('id', $request->committee_id)->with('nominationDepartments')->first();
        $department = $committee->nominationDepartments->find($request->department_id);
        $department->pivot->has_nominations = 1;
        $department->pivot->save();

        $this->setCommitteeNominationStatus($request->committee_id);
        $this->sendNotificationToNominatedDelegates($request->delegates_ids, $committee);


    }

    public function sendNotificationToNominatedDelegates($delegates, $committee)
    {
        foreach ($delegates as $delegate_id) {
            $delegate = Delegate::find($delegate_id);
            event(new DelegateCreatedEvent($delegate, $committee));
        }

    }

    public function removeDelegateFromCommittee(Delegate $delegate, $committee_id, $department_id, $reason)
    {
        CommitteeDelegate::where('user_id', $delegate->id)
            ->where('nominated_department_id', $department_id)
            ->where('committee_id', $committee_id)->delete();

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
        event(new DelegateDeletedEvent($delegate, $committee, $reason));
    }

    public function addDelegateToCommittee(Request $request, int $delegate_id)
    {
        $committee = Committee::findOrFail($request->committee_id)->with('delegates')->first();;
        $committee->delegates()->attach($delegate_id, array('nominated_department_id' => $request->parent_department_id));

        $committee1 = Committee::findOrFail($request->committee_id)->with('nominationDepartments')->first();
        $department = $committee1->nominationDepartments->find($request->parent_department_id);

        $department->pivot->has_nominations = 1;
        $department->pivot->save();

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
                })-get();

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
                    'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
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
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'specialty', 'title',
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

}