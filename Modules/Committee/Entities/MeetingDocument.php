<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\SharedModel;

class MeetingDocument extends Model
{
    use SharedModel, SoftDeletes;

    protected $fillable = [];
}
