<?php

namespace Modules\Users\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\SaveUserRequest;

class UsersController extends Controller
{

    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a New resource.
     * @return Response
     */
    public function create()
    {

    }
    
    /**
     * Store a newly created resource in storage.
     * @param SaveUserRequest $request
     * @return Response
     */
    public function store(SaveUserRequest $request)
    {
        User::createNewUser($request);  
        return response()->json(['msg' => __('users::users.userCreated')], 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
