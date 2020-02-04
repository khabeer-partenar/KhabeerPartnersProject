<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TakeAttendance
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
        if ($committee && $meeting) {
            if ($meeting->attendance_done) {
                return redirect()->route('committee.meetings.show', compact('committee', 'meeting'));
            }
        }
        return $next($request);
    }
}
