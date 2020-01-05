<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class MeetingAdvisor extends Model
{
    use SharedModel;

    protected $table = 'meetings_advisors';
    protected $fillable = [];

    const INVITED = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;
}
