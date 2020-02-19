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
        $delegate = $meeting ? $meeting->currentDelegate->first():null;
        if ($committee && $meeting && $delegate) {
            if ($delegate->pivot->status == MeetingDelegate::REJECTED) {
                abort(403);
            }
        }
        return $next($request);
    }
}

