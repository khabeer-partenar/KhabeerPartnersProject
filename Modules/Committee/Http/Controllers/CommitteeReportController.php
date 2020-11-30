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
    public function show(Committee $committee)
    {
        $meeting = $committee->firstMeeting()->first();
        $pdf = PDF::loadView('committee::reports.committee_detail_report', compact('committee','meeting'));
        return $pdf->stream($committee->subject . '.pdf');
    }
}
