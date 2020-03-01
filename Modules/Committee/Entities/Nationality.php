<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class Nationality extends Model
{
    use SharedModel;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nationalities';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];
}
