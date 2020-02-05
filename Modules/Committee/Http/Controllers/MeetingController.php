<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Http\Resources\MeetingCalendar as MeetingResource;

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
        $meetings = Meeting::filterAllByUser()->calendar($request->all())->get();
        return  MeetingResource::collection($meetings);
    }
}
