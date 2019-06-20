<?php

namespace Modules\Committe\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Committe\Entities\Committee;


class CommittePresident extends Model
{
    protected $table = 'committe_presidents';

    protected $fillable = [ 'committees_id' ,'committee_president_name'];
}
