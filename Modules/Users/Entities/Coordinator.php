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
    CONST TYPE = 'coordinator';

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
        $coordinatorJob = Group::where('key', 'coordinator')->first();
        $coordinator = self::create(
            array_merge(
            $request->only(
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
                'main_department_id', 'parent_department_id', 'department_reference'
            ), ['job_role_id' => $coordinatorJob->id, 'user_type' => self::TYPE]
            )
        );
        $coordinator->groups()->attach($coordinatorJob);
        return $coordinator;
    }

    public static function createFromRequestByCo($request)
    {
        $coordinatorJob = Group::where('key', 'coordinator')->first();
        $coordinator = self::create(
            array_merge(
                $request->only(
                    'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title', 'department_reference'
                ), [
                    'job_role_id' => $coordinatorJob->id,
                    'user_type' => self::TYPE,
                    'department_reference' => auth()->user()->department_reference,
                    'main_department_id' => auth()->user()->main_department_id,
                    'parent_department_id' => auth()->user()->parent_department_id
                ]
            )
        );
        $coordinator->groups()->attach($coordinatorJob);
        return $coordinator;
    }

    public function updateFromRequest($request)
    {
        return $this->update(
            $request->only(
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
                'main_department_id', 'parent_department_id', 'department_reference'
            )
        );
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
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('main_department_id') && $request->main_department_id != 0) {
            $query->where('main_department_id', $request->main_department_id);
        }
        if ($request->has('parent_department_id') && $request->parent_department_id != 0) {
            $query->where('parent_department_id', $request->parent_department_id);
        }
        if (auth()->user()->user_type == Coordinator::TYPE) {
            $query->where('parent_department_id', auth()->user()->parent_department_id);
        }
        return $query;
    }

    /**
     * Relations
     *
     * Here Add Relations
     */
}