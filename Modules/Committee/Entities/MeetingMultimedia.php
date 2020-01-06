<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\SharedModel;

class MeetingMultimedia extends Model
{
    use SharedModel;

    protected $fillable = ['text', 'meeting_id', 'user_id', 'committee_id'];

}