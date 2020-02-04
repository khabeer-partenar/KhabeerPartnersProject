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

        return view('committee::committees.coordinator.attendance');
    }
}
