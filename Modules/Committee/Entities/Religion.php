<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'religions';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'name_en'];


}
