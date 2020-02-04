<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;

class MeetingMultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     */
    public function index(Committee $committee, Meeting $meeting)
    {
        $meeting->load([
            'delegates' => function($query) use ($meeting){
                $query->with([
                    'multimedia' => function($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'documents' => function($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'department'
                ]);
            }
        ]);
        return view('committee::meetings.multimedia.index', compact('committee', 'meeting'));
    }
}
