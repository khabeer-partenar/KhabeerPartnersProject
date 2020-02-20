<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class CommitteeAdvisor extends Model
{
    use SharedModel;

    protected $table = 'committees_participant_advisors';

    protected $fillable = [];
}
