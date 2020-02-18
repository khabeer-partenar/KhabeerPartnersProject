<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Status;

class CommitteeGroupStatus extends Model
{
    protected $table ='committee_group_status';

    public function committeeStatus()
    {
        return  $this->hasOne(Status::class,'id','status');
    }

}