<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;

class IndexController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if($this->isApiCall) {
            //return response()->json('ss');
        }
        return view('index::index');
    }

    /**
     * Show the unauthorized user message
     * @return Response
     */
    public function unauthorizedUser()
    {
        return view('index::unauthorized-user');
    }

}
