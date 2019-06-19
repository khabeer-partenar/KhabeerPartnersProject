<?php

namespace Modules\Users\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Traits\AuthorizeUser;

class Coordinator extends Authenticatable
{
    use Notifiable, HasApiTokens, AuthorizeUser,SoftDeletes;

    protected $fillable = [
        'name', 'national_id', 'email', 'phone_number', 'direct_department_id', 'job_role_id'
    ];

}