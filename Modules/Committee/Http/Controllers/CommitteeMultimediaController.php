<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Committee;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Modules\Committee\Entities\Multimedia;
use Illuminate\Support\Facades\View;

class CommitteeMultimediaController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @return Response
     */
    public function index(Committee $committee)
    {
        $delegates = $committee->load([
            'delegates' => function ($query) use ($committee){
                $query->with([
                    'multimedia' => function ($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    },
                    'documents' => function ($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    }
                ]);
            }
        ])->delegates;

        return view('committee::committees.multimedia.index', compact('committee', 'delegates'));
    }

    /**
     * @param Committee $committee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Committee $committee)
    {
        $committee->load([
            'multimedia' => function ($query) {$query->where('user_id', auth()->id())->orderBy('created_at','asc');},
            'documents' => function ($query) { $query->where('user_id', auth()->id())->orderBy('created_at', 'asc');}
        ]);
        return view('committee::committees.multimedia.create', compact('committee'));
    }

    /**
     * @param Committee $committee
     * @param Request $request
     */
    public function store(Committee $committee, Request $request)
    {
        $request->validate([
            'text.*'=>'max:191',
        ]);
        Multimedia::createMultimedia($request->text, $committee->id);
        return back();
    }


    public function exportWord(Committee $committee, Request $request)
    {
        $delegates = $committee->load([
            'delegates' => function ($query) use ($committee, $request) {
                $query->with([
                    'multimedia' => function ($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    },
                    'documents' => function ($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    }
                ]);
            }
        ])->delegates->whereIn('id', $request->delegates);
        $headers = array(
            "Content-type"        => "text/html",
            "Content-Disposition" => "attachment;Filename=report.doc"
        );

        $content =  View::make('committee::meetings._partials.word', [
            'delegates' => $delegates,
            'committee' => $committee
        ])->render();

        return FacadesResponse::make($content, 200, $headers);
    }
}
