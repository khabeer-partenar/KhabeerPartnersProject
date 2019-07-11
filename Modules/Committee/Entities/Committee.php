<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class Committee extends Model
{
    use SharedModel;
    protected $fillable = [];
}
