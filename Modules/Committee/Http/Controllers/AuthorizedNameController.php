<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Committee\Entities\AuthorizedName;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AuthorizedListExport;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDriver;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class AuthorizedNameController extends UserBaseController
{
    use Log;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $authorizedNames = AuthorizedName::search($request->all())->paginate(5);
        $types = AuthorizedName::TYPE_TEXT;
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $meeting = Meeting::with('advisor', 'room')->get();
        return view('committee::authorizedName.authorized_list', compact('advisors', 'types', 'meeting', 'authorizedNames'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new AuthorizedListExport, 'list.xlsx');
    }

    public function print(Request $request)
    {
        $authorizedNames = AuthorizedName::search($request->all())->get();
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $meeting = Meeting::with('advisor', 'room')->get();
        $driverReligion = MeetingDriver::with('religion')->get();
        $pdf = PDF::loadView('committee::authorizedName.print', compact('advisors', 'meeting',   'driverReligion', 'authorizedNames'));
        return $pdf->stream('document.pdf');
    }
}
