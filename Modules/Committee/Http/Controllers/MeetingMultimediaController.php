<?php

namespace Modules\Committee\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\View;
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
            'delegates' => function ($query) use ($meeting) {
                $query->with([
                    'multimedia' => function ($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id)->whereNotNull('meeting_id');
                    },
                    'documents' => function ($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'department'
                ]);
            }
        ]);
        return view('committee::meetings.multimedia.index', compact('committee', 'meeting'));
    }
    public function exportWord(Committee $committee, Request $request, Meeting $meeting)
    {
        $delegates = $meeting->load([
            'delegates' => function ($query) use ($meeting) {
                $query->with([
                    'multimedia' => function ($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id)->whereNotNull('meeting_id');
                    },
                    'documents' => function ($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'department'
                ]);
            }
        ])->delegates->whereIn('id', $request->delegates);
        $headers = array(
            "Content-type"        => "text/html",
            "Content-Disposition" => "attachment;Filename=report.doc"
        );
        $content =  View::make('committee::meetings._partials.word', [
            'delegates' => $delegates,
            'committee' => $committee,
            'meeting' => $meeting
        ])->render();
        return FacadesResponse::make($content, 200, $headers);
    }
}
