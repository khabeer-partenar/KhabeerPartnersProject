<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

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


    public function syncSecretariesData($secretariesIds)
    {
        dd($secretariesIds);
    }
}
