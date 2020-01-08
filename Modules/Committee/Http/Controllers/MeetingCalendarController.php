<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Http\Requests\DocumentUploadRequest;

class MeetingCalendarController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {
        return view('committee::meetings.calendar');
    }
}
