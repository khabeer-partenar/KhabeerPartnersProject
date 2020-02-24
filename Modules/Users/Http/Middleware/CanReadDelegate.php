<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Users\Entities\Coordinator;

class CanReadDelegate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $delegate = $request->delegate;
        if ($delegate) {
            if (auth()->user() && auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
                $childrenDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
                $departmentsId = array_merge($childrenDepartments, [auth()->user()->parent_department_id]);
                if (!in_array($delegate->parent_department_id, $departmentsId)) {
                    abort(403);
                }
            } elseif (auth()->user() && auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
                if ($delegate->parent_department_id != auth()->user()->parent_department_id) {
                    abort(403);
                }
            }
            elseif (!auth()->user()->is_super_admin)
            {
                abort(403);
            }
        }
        return $next($request);
    }
}
