<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Users\Entities\Employee;

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
        if (auth()->user() && auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            $committee = $request->committee;
            if ($committee) {
                $advisorsId = auth()->user()->advisors()->pluck('users.id')->toArray();
                if (!in_array($committee->advisor_id, $advisorsId)) {
                    abort(403);
                }
            }
        } else if (auth()->user() && auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            $committee = $request->committee;
            if ($committee) {
                $owns = auth()->user()->ownedCommittees()->pluck('committees.id')->toArray();
                $participantIn = auth()->user()->participantInCommittees()->pluck('committees.id')->toArray();
                if (!in_array($committee->id, array_merge($owns, $participantIn))) {
                    abort(403);
                }
            }
        }
        return $next($request);
    }
}
