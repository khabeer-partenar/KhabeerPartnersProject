<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $table = 'logs';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'user_ip', 'user_agent', 'action_name', 'table_name', 'primary_id', 'body'];

}
