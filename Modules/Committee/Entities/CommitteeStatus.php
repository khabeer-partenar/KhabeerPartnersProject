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
        $secretaryGroupId = Group::where('key', Employee::SECRETARY)->first()->id;
        $advisorGroupId = Group::where('key', Employee::ADVISOR)->first()->id;
        $officeOfThePresidentGroupId = Group::where('key', Employee::OFFICE_OF_THE_PRESIDENT)->first()->id;
        $directorOfConsultantsOfficesGroupId = Group::where('key', Employee::DIRECTOR_OF_CONSULTANTS_OFFICES)->first()->id;
        $portfolioManagerGroupId = Group::where('key', Employee::PORTFOLIO_MANAGER)->first()->id;
        $technicalSupportGroupId = Group::where('key', Employee::TECHNICAL_SUPPORT)->first()->id;
        $chairmanOfTheCommissionGroupId = Group::where('key', Employee::CHAIRMAN_OF_THE_COMMISSION)->first()->id;
        $viceChairmanOfTheCommissionGroupId = Group::where('key', Employee::VICE_CHAIRMAN_OF_THE_COMMISSION)->first()->id;
        $delegateGroupId = Group::where('key', Delegate::JOB)->first()->id;

        $committee->groupsStatuses()->syncWithoutDetaching(
            [$secretaryGroupId => ['status' => $status]
                , $advisorGroupId => ['status' => $status]
                , $officeOfThePresidentGroupId => ['status' => $status]
                , $directorOfConsultantsOfficesGroupId => ['status' => $status]
                , $portfolioManagerGroupId => ['status' => $status]
                , $technicalSupportGroupId => ['status' => $status]
                , $chairmanOfTheCommissionGroupId => ['status' => $status]
                , $viceChairmanOfTheCommissionGroupId => ['status' => $status]
                , $delegateGroupId => ['status' => $status]
            ]);

    }

}
