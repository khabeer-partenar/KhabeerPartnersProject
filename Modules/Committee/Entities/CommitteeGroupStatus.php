<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Status;
use Modules\Core\Traits\SharedModel;

class CommitteeGroupStatus extends Model
{
    use SharedModel;
    protected $table ='committee_group_status';

    public function committeeStatus()
    {
        return  $this->hasOne(Status::class,'id','status');
    }


}
