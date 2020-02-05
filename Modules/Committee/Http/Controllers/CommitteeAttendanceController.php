<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;

class CommitteeAttendanceController extends Controller
{
    /**
     * Show the specified resource.
     * @param Committee $committee
     * @return Response
     */
    public function show(Committee $committee)
    {
        $committee->load(['meetings' => function($query) {
            $query->with([
                'delegates' => function($query) {
                    $query->whereIn('parent_department_id', auth()->user()->coordinatorAuthorizedIds())->with('department');
                },
                'type'
            ])->orderBy('from', 'asc');
        }]);
        return view('committee::committees.coordinator.attendance', compact('committee'));
    }
}
