<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Users\Entities\Coordinator;

class CheckCoordinatorAuthority
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
        if (auth()->user() && auth()->user()->user_type == Coordinator::TYPE) {
            $coordinator = $request->coordinator;
            if ($coordinator) {
                if (auth()->user()->parent_department_id != $coordinator->department_reference_id
                    && auth()->user()->parent_department_id != $coordinator->parent_department_id) {
                    abort(403);
                }
            } else {
                $department = auth()->user()->parentDepartment;
                if (!$department->is_reference) {
                    abort(403);
                }
            }
        }
        return $next($request);
    }
}
