<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class CommitteeView extends Model
{
    use SharedModel;
    protected $table = 'committee_view';
    protected $fillable = ['committee_id','user_id'];
}