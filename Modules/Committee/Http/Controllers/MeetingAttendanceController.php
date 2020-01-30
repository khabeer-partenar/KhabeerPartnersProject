<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Http\Requests\SaveMeetingAttendance;

class MeetingAttendanceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     */
    public function create(Committee $committee, Meeting $meeting)
    {
        $meeting->load('delegates', 'participantAdvisors');
        return view('committee::meetings.attendance.create', compact('committee', 'meeting'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Committee $committee
     * @param Meeting $meeting
     * @param Request $request
     * @return Response
     */
    public function store(Committee $committee, Meeting $meeting, SaveMeetingAttendance $request)
    {
        $meeting->attend($request->all());
        return redirect()->route('committee.meetings.show', compact('committee','meeting'));
    }
}
