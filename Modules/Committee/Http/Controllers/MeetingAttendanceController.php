<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;

class MeetingAttendanceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param Committee $committee
     * @return Response
     */
    public function create(Committee $committee)
    {
        //
        return view('committee::meetings.attendance.create', compact('committee'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }
}
