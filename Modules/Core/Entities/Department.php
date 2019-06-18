<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Modules\Core\Traits\SharedModel;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'name', 'type'];

}
