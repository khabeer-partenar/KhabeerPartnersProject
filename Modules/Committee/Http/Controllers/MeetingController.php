<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingAdvisor;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Http\Requests\DocumentUploadRequest;

class MeetingController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $meetings = Meeting::filterAllByUser()->with([
            'advisor',
            'attendingDelegates',
            'attendingAdvisors',
            'absentDelegates',
            'absentAdvisors',
            'room',
            'type',
        ])->calendar()->get();

        return view('committee::meetings.calendar', compact('meetings'));
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
