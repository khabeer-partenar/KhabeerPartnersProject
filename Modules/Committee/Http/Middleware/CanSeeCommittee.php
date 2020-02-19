<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Committee\Entities\CommitteeDepartment;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Mpdf\Tag\Del;

class CanSeeCommittee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $committee = $request->committee;
        if (auth()->user() && auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            if ($committee) {
                $advisorsId = auth()->user()->advisors()->pluck('users.id')->toArray();
                if (!in_array($committee->advisor_id, $advisorsId)) {
                    abort(403);
                }
            }
        } else if (auth()->user() && auth()->user()->authorizedApps->key != Employee::ADVISOR) {
            if ($committee) {
                $participantIn = auth()->user()->participantInCommittees()->pluck('committees.id')->toArray();
                if (!in_array($committee->id, $participantIn) && $committee->advisor_id == auth()->id()) {
                    abort(403);
                }
            }
        }
        elseif (auth()->user() && auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            if ($committee) {
                $departmentsId = auth()->user()->coordinatorAuthorizedIds();
                $committeeIds = CommitteeDepartment::whereIn('department_id', $departmentsId)->pluck('committee_id')->toArray();
                if (!in_array($committee->id, $committeeIds)) {
                    abort(403);
                }
            }
        } elseif (auth()->user() && auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            if ($committee) {
                $parentDepartmentId = auth()->user()->parentDepartment->pluck('id');
                $committeeIds = CommitteeDepartment::whereIn('department_id', $parentDepartmentId)
                    ->pluck('committee_id')->toArray();
                if (!in_array($committee->id, $committeeIds)) {
                    abort(403);
                }
            }
        } else if (auth()->user() && auth()->user()->authorizedApps->key == Delegate::JOB) {
            if ($committee) {
                $delegate = Delegate::find(auth()->user()->id);
                $committeeIds = $delegate->committees()->pluck('committees.id')->toArray();
                if (!in_array($committee->id, $committeeIds)) {
                    abort(403);
                }
            }
        }
        return $next($request);
    }
}
