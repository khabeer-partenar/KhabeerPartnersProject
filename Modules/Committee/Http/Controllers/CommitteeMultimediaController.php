<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Multimedia;
use Modules\Users\Entities\Delegate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommitteeMultimediaExport;
use Modules\Committee\Entities\Meeting;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CommitteeMultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @return Response
     */
    public function index(Committee $committee)
    {
        $delegates = $committee->load([
            'delegates' => function ($query) use ($committee) {
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
        $committee->load(['multimedia' => function ($query) {
            $query->where('user_id', auth()->id())->orderBy('created_at','asc');
        }]);
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

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new CommitteeMultimediaExport, 'list.xlsx');
    }
}
