<?php


namespace Modules\Committee\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Group;
use Modules\Core\Entities\Status;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;

class CommitteeStatus extends Model
{
    use SharedModel, Log;
    protected $table = "committee_group_status";

    public static function createCommitteeGroupsStatus(Committee $committee)
    {
        $secretaryGroupId = Group::where('key', Employee::SECRETARY)->first()->id;
        $advisorGroupId = Group::where('key', Employee::ADVISOR)->first()->id;
        $coordinatorGroupId = Group::where('key', Coordinator::NORMAL_CO_JOB)->first()->id;
        $mainCoordinatorGroupId = Group::where('key', Coordinator::MAIN_CO_JOB)->first()->id;
        $committee->groupsStatuses()->sync([$secretaryGroupId => ['status' => Status::WAITING_DELEGATES]
            , $advisorGroupId => ['status' => Status::WAITING_DELEGATES]
            , $coordinatorGroupId => ['status' => Status::NOMINATIONS_NOT_DONE]
            , $mainCoordinatorGroupId => ['status' => Status::NOMINATIONS_NOT_DONE]]);

    }

}