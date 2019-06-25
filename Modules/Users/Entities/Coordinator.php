<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
namespace Modules\Users\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\AuthorizeUser;
use Modules\Core\Traits\SharedModel;

class Coordinator extends Authenticatable
{
    use Notifiable, HasApiTokens, AuthorizeUser, SoftDeletes, SharedModel;

    protected $fillable = [
        'name', 'national_id', 'email', 'phone_number', 'direct_department_id', 'job_role_id', 'department_reference',
        'job_title', 'title', 'main_department_id', 'parent_department_id'
    ];

    /**
     * Functions
     *
     * Add Functions
     */
    public static function createFromRequest($request)
    {
        $coordinatorJob = Group::where('key', 'coordinator')->first();
        $coordinator = self::create(
            array_merge(
            $request->only(
                'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_title', 'title',
                'main_department_id', 'parent_department_id', 'department_reference'
            ), ['job_role_id' => $coordinatorJob->id]
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

    public function job()
    {
        return $this->groups()->first();
    }

    /**
     * Scopes
     *
     * Here add Scopes
     * @param $query
     * @param Request $request
     */
    public static function scopeSearch($query, Request $request)
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
        return $query;
    }

    /**
     * Relations
     *
     * Here Add Relations
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'core_users_groups', 'user_id', 'core_group_id');
    }

    public function directDepartment()
    {
        return $this->belongsTo(Department::class, 'direct_department_id');
    }

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    public function mainDepartment()
    {
        return $this->belongsTo(Department::class, 'main_department_id');
    }
}