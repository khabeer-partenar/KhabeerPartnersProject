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
        $secretaryGroupId = Group::where('key', Employee::SECRETARY)->first()->id;
        $advisorGroupId = Group::where('key', Employee::ADVISOR)->first()->id;
        $officeOfThePresidentGroupId = Group::where('key', Employee::OFFICE_OF_THE_PRESIDENT)->first()->id;
        $directorOfConsultantsOfficesGroupId = Group::where('key', Employee::DIRECTOR_OF_CONSULTANTS_OFFICES)->first()->id;
        $associateConsultantGroupId = Group::where('key', Employee::ASSOCIATE_CONSULTANT)->first()->id;
        $portfolioManagerGroupId = Group::where('key', Employee::PORTFOLIO_MANAGER)->first()->id;
        $technicalSupportGroupId = Group::where('key', Employee::TECHNICAL_SUPPORT)->first()->id;
        $chairmanOfTheCommissionGroupId = Group::where('key', Employee::CHAIRMAN_OF_THE_COMMISSION)->first()->id;
        $viceChairmanOfTheCommissionGroupId = Group::where('key', Employee::VICE_CHAIRMAN_OF_THE_COMMISSION)->first()->id;

        $coordinatorGroupId = Group::where('key', Coordinator::NORMAL_CO_JOB)->first()->id;
        $mainCoordinatorGroupId = Group::where('key', Coordinator::MAIN_CO_JOB)->first()->id;
        $delegateGroupId = Group::where('key', Delegate::JOB)->first()->id;

        $committee->groupsStatuses()->sync([
            $secretaryGroupId => ['status' => Status::WAITING_DELEGATES],
            $advisorGroupId => ['status' => Status::WAITING_DELEGATES],
            $officeOfThePresidentGroupId => ['status' => Status::WAITING_DELEGATES],
            $directorOfConsultantsOfficesGroupId => ['status' => Status::WAITING_DELEGATES],
            $associateConsultantGroupId => ['status' => Status::WAITING_DELEGATES],
            $portfolioManagerGroupId => ['status' => Status::WAITING_DELEGATES],
            $technicalSupportGroupId => ['status' => Status::WAITING_DELEGATES],
            $chairmanOfTheCommissionGroupId => ['status' => Status::WAITING_DELEGATES],
            $viceChairmanOfTheCommissionGroupId => ['status' => Status::WAITING_DELEGATES],
            $coordinatorGroupId => ['status' => Status::NOMINATIONS_NOT_DONE],
            $mainCoordinatorGroupId => ['status' => Status::NOMINATIONS_NOT_DONE],
            $delegateGroupId => ['status' => Status::NOMINATIONS_NOT_DONE]
        ]);
    }

    public static function updateCommitteeGroupStatus(Committee $committee, $status)
    {
        $coordinatorGroupId = Group::where('key', Coordinator::NORMAL_CO_JOB)->first()->id;
        $mainCoordinatorGroupId = Group::where('key', Coordinator::MAIN_CO_JOB)->first()->id;
        $delegateGroupId = Group::where('key', Delegate::JOB)->first()->id;

        $committee->groupsStatuses()->syncWithoutDetaching(
            [$coordinatorGroupId => ['status' => $status]
                , $mainCoordinatorGroupId => ['status' => $status]
                , $delegateGroupId => ['status' => $status]
            ]);
    }

    public static function updateCommitteeGroupsStatusToNominationsCompleted(Committee $committee,$status)
    {
        $secretaryGroupId = Group::where('key', Employee::SECRETARY)->first()->id;
        $advisorGroupId = Group::where('key', Employee::ADVISOR)->first()->id;
        $officeOfThePresidentGroupId = Group::where('key', Employee::OFFICE_OF_THE_PRESIDENT)->first()->id;
        $directorOfConsultantsOfficesGroupId = Group::where('key', Employee::DIRECTOR_OF_CONSULTANTS_OFFICES)->first()->id;
        $associateConsultantGroupId = Group::where('key', Employee::ASSOCIATE_CONSULTANT)->first()->id;
        $portfolioManagerGroupId = Group::where('key', Employee::PORTFOLIO_MANAGER)->first()->id;
        $technicalSupportGroupId = Group::where('key', Employee::TECHNICAL_SUPPORT)->first()->id;
        $chairmanOfTheCommissionGroupId = Group::where('key', Employee::CHAIRMAN_OF_THE_COMMISSION)->first()->id;
        $viceChairmanOfTheCommissionGroupId = Group::where('key', Employee::VICE_CHAIRMAN_OF_THE_COMMISSION)->first()->id;

        $committee->groupsStatuses()->syncWithoutDetaching(
            [$secretaryGroupId => ['status' => $status]
                , $advisorGroupId => ['status' => $status]
                , $officeOfThePresidentGroupId => ['status' => $status]
                , $directorOfConsultantsOfficesGroupId => ['status' => $status]
                , $associateConsultantGroupId => ['status' => $status]
                , $portfolioManagerGroupId => ['status' => $status]
                , $technicalSupportGroupId => ['status' => $status]
                , $chairmanOfTheCommissionGroupId => ['status' => $status]
                , $viceChairmanOfTheCommissionGroupId => ['status' => $status]
            ]);

    }

}