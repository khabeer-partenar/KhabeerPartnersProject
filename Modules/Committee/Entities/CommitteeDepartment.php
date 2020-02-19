<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class CommitteeDepartment extends Model
{
    use SharedModel;

    protected $fillable = [];

    protected $table = 'committees_participant_departments';
}
