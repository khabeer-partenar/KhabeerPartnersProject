<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Core\Entities\Group;

class Coordinator extends User
{
    const TYPE = 'coordinator';
    const MAIN_CO_JOB = 'main_coordinator';
    const NORMAL_CO_JOB = 'coordinator';

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

    /**
     * Functions
     *
     * Add Functions
     * @param $request
     * @return
     */
    public static function createFromRequest($request)
    {
        $coordinator = self::create(
            array_merge(
            $request->only(
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
                'main_department_id', 'parent_department_id', 'department_reference_id', 'job_role_id'
            ), ['user_type' => self::TYPE]
            )
        );
        $coordinator->groups()->attach($coordinator->job_role_id);
        return $coordinator;
    }


    public function updateFromRequest($request)
    {
        $this->update(
            $request->only(
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
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
        if (auth()->user()->user_type == Coordinator::TYPE) {
            $coordinatorsIds = $query->where(function ($query) {
                $query->where('department_reference_id', auth()->user()->parent_department_id)
                ->orWhere('parent_department_id', auth()->user()->parent_department_id);
            })->pluck('id');
        }
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('main_department_id') && $request->main_department_id != 0) {
            $query->where('main_department_id', $request->main_department_id);
        }
        if ($request->has('parent_department_id') && $request->parent_department_id != 0) {
            $query->where('parent_department_id', $request->parent_department_id);
        }
        if (isset($coordinatorsIds)) {
            $query->whereIn('id', $coordinatorsIds);
        }
        return $query;
    }
    public function coordinatorCommittees($coordinator_id)
    {
        $coordinatorParentDepartment= auth()->user()->parentDepartment->id;
    }

    /**
     * Relations
     *
     * Here Add Relations
     */
}