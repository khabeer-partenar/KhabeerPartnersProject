<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Group;
use Yajra\Datatables\Datatables;

class UsersController extends UserBaseController
{
    
    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $usersData = User::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->paginate(10);
            return response()->json($usersData, 200);
        }
        
        return view('core::users.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'main_department_id'   => 'required|integer',
            'parent_department_id' => 'required|integer',
            'direct_department_id' => 'required|integer',
            'national_id'          => 'required|integer|unique:'. User::table(),
            'name'                 => 'required|string',
            'phone_number'         => 'required|unique:'. User::table(),
            'email'                => 'required|email|unique:'. User::table(),
            'job_role_id'          => 'required|integer|exists:'. Group::table() .',id',
        ]);
        
        $userData = User::create($request->only('direct_department_id', 'national_id', 'name', 'phone_number', 'email'));
        $userData->groups()->attach($request->job_role_id);

        return response(null, 200);
    }

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $usersData = User::search($request->input('search'))->select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->get();
        return response()->json(['data' => $usersData, 'total' => $usersData->count()], 200);
    }

    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, $userID) 
    {
        $userData = User::findOrFail($userID);
        $userData->is_super_admin = !$userData->is_super_admin;
        $userData->save();

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('core.users.index');
    }

    /**
     * search in users
     */
    public function groups(Request $request)
    {
        $groups = Group::select('id', 'name')->get();
        return $groups;
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        $userData->delete();

        return response()->json(null, 200);
    }
}
