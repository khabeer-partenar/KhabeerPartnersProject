<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class MeetingDelegate extends Model
{
    use SharedModel;

    protected $table = 'meetings_delegates';
    protected $fillable = [];
}
