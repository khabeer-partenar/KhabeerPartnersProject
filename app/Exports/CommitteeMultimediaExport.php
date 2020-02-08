<?php

namespace App\Exports;

use Modules\Committee\Entities\Committee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Users\Entities\Delegate;

class CommitteeMultimediaExport implements FromView
{
    public function view(): View
    {
        return view('committee::meetings._partials.export', 
        [
            'delegates' => Delegate::all(),

        ])
        ;
    }
}





