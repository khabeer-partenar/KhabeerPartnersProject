<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Delegate;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
class CommitteeReportController extends Controller
{

    public function exportAllInfo(Committee $committee)
    {
        $delegates = $committee->getDelegatesWithDetails();
       // return view('committee::reports.committee_detail_report', compact('committee', 'delegates'));

        $pdf = PDF::loadView('committee::reports.committee_detail_report', compact('committee', 'delegates'));
        $pdf->mpdf->SetWatermarkText(auth()->user()->name);
        //$pdf->mpdf->showWatermarkText = true;
        //$pdf->mpdf->watermark_font = 'XBZar, XBRiyaz - Arabic';
        return $pdf->stream($committee->subject . '.pdf');

    }


}
