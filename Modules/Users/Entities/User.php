<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Traits\AuthorizeUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Entities\Group;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, AuthorizeUser, SoftDeletes, \Modules\Core\Traits\SharedModel;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'national_id', 'email', 'phone_number', 'direct_department_id', 'is_super_admin'
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
    * Get user groups
    */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'core_users_groups', 'user_id', 'core_group_id');
    }

    public function checkInGroup($key = null)
    {
        return $this->groups()->where('key', '=', $key)->exists();
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
