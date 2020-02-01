<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;

class CommitteeView extends Model
{
    protected $table = 'committee_view';
    protected $fillable = ['committee_id','user_id'];
}