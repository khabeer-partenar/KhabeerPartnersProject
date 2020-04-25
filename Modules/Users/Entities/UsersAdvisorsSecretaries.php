<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class UsersAdvisorsSecretaries extends Model
{
    use \Modules\Core\Traits\SharedModel;

    protected $table = 'users_advisors_secretaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advisor_user_id', 'secretary_user_id'
    ];


    public static function ScopeAdvisorsId($query,$secretary_id)
    {
        return $query->where('secretary_user_id',$secretary_id)->pluck('advisor_user_id')->toArray();
    }
    /**
     * Get secretary user data
     */
    public function secretaryData()
    {
        return $this->hasOne(User::class, 'id', 'secretary_user_id');
    }

}
