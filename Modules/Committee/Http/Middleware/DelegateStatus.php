<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Committee\Entities\MeetingDelegate;

class DelegateStatus
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
        $meeting = $request->meeting;
        $committee = $request->committee;
        $delegate = $request->delegate;
        if ($committee && $meeting) {
            if (auth()->user() && $meeting->delegates[0]->pivot->status == MeetingDelegate::REJECTED) {
                return redirect()->route('committee.meetings.show', compact('committee', 'meeting'));
            }
        }
        return $next($request);
    }
}

