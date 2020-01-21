<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\SharedModel;

class MeetingType extends Model
{
    use SharedModel, SoftDeletes;

    protected $table = 'meetings_types';
    protected $fillable = ['name', 'active', 'color', 'slug'];

    const PRIMARY = 0;
    const PERFECTING = 1;
    const SIGNATURE = 2;
}
