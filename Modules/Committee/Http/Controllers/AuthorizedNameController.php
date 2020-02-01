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

        $lists = AuthorizedName::search($request->all())->paginate(10);
        $types = AuthorizedName::TYPE_TEXT;
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        return view('committee::authorizedName.authorized_list', compact('lists', 'advisors', 'types'));

    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        return Excel::download(new AuthorizedListExport, 'list.xlsx');

    }

    public function print(Request $request)
    {
        $lists = AuthorizedName::search($request->all())->get();
        $pdf = PDF::loadView('committee::authorizedName.print', compact('lists'));
        return $pdf->stream('document.pdf');

    }


}
