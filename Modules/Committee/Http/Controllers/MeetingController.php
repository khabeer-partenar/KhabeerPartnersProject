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
     * @return Response
     */
    public function index()
    {
        $meetings = Meeting::filterAllByUser()->with([
            'committee' => function($query) {$query->with('advisor');},
            'attendingDelegates',
            'attendingAdvisors',
            'absentDelegates',
            'absentAdvisors',
            'room',
            'type',
        ])->get();

        return view('committee::meetings.calendar', compact('meetings'));
    }
}
