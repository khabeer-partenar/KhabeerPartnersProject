<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class TreatmentType extends Model
{
    use SharedModel;

    protected $fillable = ['name', 'description'];
}
