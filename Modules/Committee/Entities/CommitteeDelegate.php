<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Coordinator;

class CommitteeDelegate extends Model
{
    protected $fillable = [];
    protected $table = 'committee_delegate';

    public static function getDelegates($department_id, $committee_id)
    {
        $delegates = CommitteeDelegate::where('committee_id', $committee_id)
            ->where('nominated_department_id', $department_id)->get();

        return $delegates;

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
