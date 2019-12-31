<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\Coordinator;

class CommitteeDelegate extends Model
{
    use SharedModel, Log, SoftDeletes;

    protected $fillable = [];
    protected $table = 'committee_delegate';

    public static function getDelegates($department_id, $committee_id)
    {
        $delegates = CommitteeDelegate::where('committee_id', $committee_id)
            ->where('nominated_department_id', $department_id)->get();

        return $delegates;

    }

    public static function getDelegateNominations($id)
    {
        $nominations = CommitteeDelegate::where('user_id', $id)->get();
        return $nominations;
    }

    public static function getDepartmentNominations($parentDepartmentId,$delegate_id)
    {
        $nominations = CommitteeDelegate::where('nominated_department_id', $parentDepartmentId)
            ->where('user_id', $delegate_id)
            ->get();

        return $nominations;
    }

    public static function getCommitteeDepartmentNominationTotal($committee_id,$parentDepartmentId)
    {
        $nominationsCount = CommitteeDelegate::where('nominated_department_id', $parentDepartmentId)
            ->where('committee_id', $committee_id)
            ->count();

        return $nominationsCount;
    }

    public static function checkIfMainCoordinatorNominateDelegates($committee_id)
    {
        if (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            $delegates = CommitteeDelegate::getDelegates(auth()->user()->parentDepartment()->first()->id, $committee_id);
            foreach ($delegates as $delegate) {
                $mainCoordinator = Coordinator::with('jobRole')->get()->find($delegate->coordinator_id);
                if ($mainCoordinator->jobRole->key == Coordinator::MAIN_CO_JOB) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }
}
