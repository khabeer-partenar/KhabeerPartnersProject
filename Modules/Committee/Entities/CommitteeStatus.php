<?php


namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Group;
use Modules\Core\Entities\Status;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class CommitteeStatus extends Model
{
    use SharedModel, Log;
    protected $table = "committee_group_status";

    public static function createCommitteeGroupsStatus(Committee $committee)
    {
        $employeeGroups = Group::where('key', '<>', [
            Coordinator::MAIN_CO_JOB,
            Coordinator::NORMAL_CO_JOB
        ])->pluck('id');
        
        $syncArr = [];
        foreach ($employeeGroups as $groupId) {
            $syncArr[$groupId] = ['status' => Status::WAITING_DELEGATES];
        }
        
        $committee->groupsStatuses()->sync($syncArr);
    }


    public static function updateCommitteeGroupsStatusToNominationsCompleted(Committee $committee,$status)
    {
        $employeeGroups = Group::where('key', '<>', [
            Coordinator::MAIN_CO_JOB,
            Coordinator::NORMAL_CO_JOB
        ])->pluck('id');

        $syncArr = [];
        foreach ($employeeGroups as $groupId) {
            $syncArr[$groupId] = ['status' => $status];
        }

        $committee->groupsStatuses()->syncWithoutDetaching($syncArr);
    }
}
