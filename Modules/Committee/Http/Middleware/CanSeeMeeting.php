<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Committee\Entities\Meeting;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;

class CanSeeMeeting
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
        $meeting = $request->meeting;
        if ($committee && $meeting) {
            if ($meeting->committee_id != $committee->id) {
                abort(404);
            }
            if (auth()->user()->user_type == Delegate::TYPE) {
                $count = $meeting->delegatesPivot()->where('delegate_id', auth()->id())->count();
                if ($count == 0) {
                    abort(403);
                }
            }
        }
        return $next($request);
    }
}
