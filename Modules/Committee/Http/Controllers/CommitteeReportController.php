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
        $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);

        //return view('committee::committees.committee_report', compact('committee', 'delegates', 'mainDepartments', 'delegateJobs'));

        $pdf = PDF::loadView('committee::committees.committee_report', compact('committee', 'delegates', 'mainDepartments', 'delegateJobs'));
        $pdf->mpdf->SetWatermarkText(auth()->user()->name);
        $pdf->mpdf->showWatermarkText = true;
        $pdf->mpdf->watermark_font = 'DejaVuSansCondensed';
        return $pdf->stream('document.pdf');

    }


}
