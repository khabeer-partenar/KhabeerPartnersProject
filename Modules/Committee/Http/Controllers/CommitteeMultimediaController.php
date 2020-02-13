<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Committee;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommitteeMultimediaExport;

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
            'delegates' => function($query) use ($committee){
                $query->with([
                    'multimedia' => function($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    },
                    'documents' => function($query) use ($committee) {
                        $query->where('committee_id', $committee->id);
                    }
                ]);
            }
        ])->delegates;

        return view('committee::committees.multimedia.index', compact('committee', 'delegates'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
    */
    public function export()
    {
        return Excel::download(new CommitteeMultimediaExport, 'list.xlsx');

    }
    
}
