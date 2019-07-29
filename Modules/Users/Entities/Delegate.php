<?php


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use DB;

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

    public function  addDelegatesToCommittee(Request $request)
    {
    //dd($request->all());
        $committee = Committee::where('id',$request->committee_id)->first();
        $committee->delegates()->attach($request->delegates_ids);

        $committee = Committee::where('id',$request->committee_id)->with('nominationDepartments')->first();
        $department = $committee->nominationDepartments->find($request->department_id);
        $department->pivot->has_nominations = 1;
        $department->pivot->save();
    }
    public function removeDelegateFromCommittee($delegate_id)
    {
        $delegate1 = Delegate::findOrFail($delegate_id);
        $delegate1->committees()->detach();


    }
    public function  addDelegateToCommittee(Request $request,int $delegate_id)
    {
        $committee = Committee::findOrFail($request->committee_id);
        $committee->delegates()->attach($delegate_id);
    }

    public function scopeNotInCommittees($query)
    {
        return $query->doesntHave('committees');
    }

    public static function getDepartmentDelegatesNotInCommittee($department_id)
    {

        $delegatesQuery = Delegate::with(['department' => function ($query) {
            $query->with('referenceDepartment');
        }])->where('parent_department_id',$department_id)
            ->orWhere('direct_department_id',$department_id)->NotInCommittees()->distinct()->get();
        $depart_id=collect();
        $depart_id->put('department_id',$department_id);
        return [$delegatesQuery,$depart_id];
        //return     $delegatesQuery;

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
                    'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title',  'title',
                    'main_department_id', 'parent_department_id', 'department_reference_id', 'job_role_id'
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
        return $this->belongsToMany(Committee::class, 'committee_delegate', 'user_id', 'committee_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

}