<?php

namespace Modules\Committee\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\Committee;

class CanSeeCommittee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $committee = $request->committee;
        if ($committee && auth()->user()->authorizedApps) {
            $dbCommittee = Committee::filter()
                ->where('committees.id', $committee->id)
                ->first();

            if (!$dbCommittee) {
                abort(403);
            }
        }
        return $next($request);
    }
}
