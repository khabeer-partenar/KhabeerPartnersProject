<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Meeting;

class MeetingController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        return view('committee::meetings.calendar.index');
    }

    public function calendar(Request $request)
    {
        $meetings = Meeting::filterAllByUser()->with([
            'advisor',
            'attendingDelegates',
            'attendingAdvisors',
            'absentDelegates',
            'absentAdvisors',
            'room',
            'type',
        ])->calendar($request->all())->get();

        return response()->json(['meetings' => $meetings]);
    }
}
