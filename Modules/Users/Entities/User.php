<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Traits\AuthorizeUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\SharedModel;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, AuthorizeUser, SoftDeletes, SharedModel;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'national_id', 'email', 'phone_number', 'direct_department_id', 'job_role_id', 'department_reference',
        'job_title', 'title', 'main_department_id', 'parent_department_id', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * get Job role name
     */
    public function jobRole()
    {
        return $this->hasOne(Group::class, 'id', 'job_role_id');

    }

    /**
     * get Job role name
     */
    public function directDepartment()
    {
        return $this->belongsTo(Department::class, 'direct_department_id', 'id');
    }

    /**
    * Get user groups
    */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'core_users_groups', 'user_id', 'core_group_id');
    }

    /**
     * Check if user has group
     */
    public function checkInGroup($key = null)
    {
        return $this->groups()->where('key', '=', $key)->exists();
    }

    /**
     * Get advisors of current users
     */
    public function advisors()
    {
        return $this->hasMany(UsersAdvisorsSecretaries::class, 'secretary_user_id');
    }

    /**
     * Get secretaries of current users
     */
    public function secretaries()
    {
        return $this->hasMany(UsersAdvisorsSecretaries::class, 'advisor_user_id');
    }

    /**
     * check if user has president group
     */
    public function hasPresidentsGroup()
    {
        return $this->checkInGroup('office_of_the_president');
    }

    /**
     * check if user has advisor group
     */
    public function hasAdvisorsGroup()
    {
        return $this->checkInGroup('advisor');
    }

    /**
     * check if user has director of consultants office group
     */
    public function hasDirectorOfConsultantsGroup()
    {
        return $this->checkInGroup('director_of_consultants_offices');
    }

    /**
     * check if user has secretaries group
     */
    public function hasSecretariesGroup()
    {
        return $this->checkInGroup('secretary');
    }

    /**
     * check if user has associate consultants group
     */
    public function hasAssociateConsultantsGroup()
    {
        return $this->checkInGroup('associate_consultant');
    }

    /**
     * check if user has portfolio managers group
     */
    public function hasPortfolioManagersGroup()
    {
        return $this->checkInGroup('portfolio_manager');
    }

    /**
     * check if user has technical supports group
     */
    public function hasTechnicalSupportsGroup()
    {
        return $this->checkInGroup('technical_support');
    }

    /**
     * check if user has ministers group
     */
    public function hasMinistersGroup()
    {
        return $this->checkInGroup('minister');
    }

    /**
     * check if user has director of ministers office group
     */
    public function hasDirectorOfMinistersGroup()
    {
        return $this->checkInGroup('director_of_the_minister_office');
    }

    /**
     * check if user has coordinators group
     */
    public function hasCoordinatorsGroup()
    {
        return $this->checkInGroup('coordinator');
    }

    /**
     * check if user has delegates group
     */
    public function hasDelegatesGroup()
    {
        return $this->checkInGroup('delegate');
    }

    /**
     * check if user has acting delegates group
     */
    public function hasActingDelegatesGroup()
    {
        return $this->checkInGroup('acting_delegate');
    }

    /**
     * Search for user by query token
     * @param $query token search
     * @return Collection users
     */
    public static function search($query)
    {
        return self::where('id', 'LIKE', '%'.$query.'%')
                  ->orWhere('name', 'LIKE', '%'.$query.'%')
                  ->orWhere('national_id', 'LIKE', '%'.$query.'%')
                  ->orWhere('email', 'LIKE', '%'.$query.'%')
                  ->orWhere('phone_number', 'LIKE', '%'.$query.'%');
    }

}
