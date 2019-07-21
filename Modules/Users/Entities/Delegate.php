<?php


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;

class Delegate extends User
{
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
        if (auth()->user()->user_type == Delegate::TYPE) {
            $delegatesIds = $query->where(function ($query) {
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
        return $this->belongsToMany(Committee::class, 'committee_user', 'user_id', 'committee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }
}