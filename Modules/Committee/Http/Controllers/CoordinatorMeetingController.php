<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\SystemManagement\Entities\Department;

class CoordinatorMeetingController extends Controller // UserBase
{
    /**
     * Show the specified resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function show(Committee $committee, Meeting $meeting)
    {
        $meeting->load(['delegates' => function($query) {
            $query->whereIn('parent_department_id', auth()->user()->coordinatorAuthorizedIds())->with('department');
        }]);
        return view('committee::meetings.coordinator.show', compact('meeting', 'committee'));
    }
}
