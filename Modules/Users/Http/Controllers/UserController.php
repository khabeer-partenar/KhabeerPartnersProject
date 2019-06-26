<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Entities\User;

class UserController extends UserBaseController
{

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $usersData = User::search($request->input('search'))->select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->get();
        return response()->json($usersData, 200);
    }

}
