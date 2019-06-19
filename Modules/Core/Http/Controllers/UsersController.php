<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Group;
use Modules\Core\Entities\Department;

class UsersController extends UserBaseController
{
    
    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $users = User::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin');

            return Datatables::of($users)
               ->addColumn('action', function ($user) {
                   return '
                    <a href="'. route('core.users.upgrate_to_super_admin', $user->id) .'" class="btn btn-xs btn-'. ($user->is_super_admin == 1 ? 'danger' : 'primary') .' confirm-message">
                        <i class="fa fa-key"></i> Admin
                    </a>

                    <a href="'. route('core.users.edit', $user->id) .'" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i> تعديل المتسخدم
                    </a>

                    <a href="'. route('core.users.destroy-confirmation', $user->id) .'" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> تعطيل المستخدم
                    </a>

                    ';
               })
               ->make(true);
        } else {
            return view('core::users.index');
        }
    }

    /**
     * Show the form for creating a New resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments   = Department::mainDepartments()->select('name', 'id')->get();
        $parentDepartments = Department::parentDepartments($mainDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments = Department::directDepartments($parentDepartments[0]->id)->select('name', 'id')->get();
        $rolesData         = Group::pluck('name', 'id')->prepend('', '');

        // pluck query to be valid in laravelcollective
        $mainDepartments   = $mainDepartments->pluck('name', 'id');
        $parentDepartments = $parentDepartments->pluck('name', 'id');
        $directDepartments = $directDepartments->pluck('name', 'id')->prepend('', '');

        return view('core::users.create', compact(['mainDepartments', 'parentDepartments', 'directDepartments', 'rolesData']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'main_department_id'   => 'required|integer|exists:'. Department::table() .',id',
            // 'parent_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'direct_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'national_id'          => 'required|national_id|unique:'. User::table(),
            'name'                 => 'required|filter_string|string',
            'phone_number'         => 'required|phone_number|unique:'. User::table(),
            'email'                => 'required|email|gov_email|unique:'. User::table(),
            'job_role_id'          => 'required|integer|exists:'. Group::table() .',id',
        ]);
        
        $userData = User::createNewUser($request);

        if($userData == null) {

            if($this->isApiCall) {
                return response()->json(__('core::.users.userNotCreated'), 422);
            }
            else {
                session()->flash('alert-danger', __('core::.users.userNotCreated')); 
                return redirect()->route('core.users.index');
            }

        }

        if($this->isApiCall) {
            return response()->json(__('core::.users.userCreated'), 200);
        }
        
        session()->flash('alert-success', __('core::.users.userCreated')); 
        return redirect()->route('core.users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        return view('core::users.show', compact('userData'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $userID)
    {
        $userData          = User::findOrFail($userID);

        $mainDepartments   = Department::mainDepartments()->select('name', 'id')->get();
        $parentDepartments = Department::parentDepartments($mainDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments = Department::directDepartments($parentDepartments[0]->id)->select('name', 'id')->get();
        $rolesData         = Group::pluck('name', 'id')->prepend('', '');

        // pluck query to be valid in laravelcollective
        $mainDepartments   = $mainDepartments->pluck('name', 'id');
        $parentDepartments = $parentDepartments->pluck('name', 'id');
        $directDepartments = $directDepartments->pluck('name', 'id')->prepend('', '');

        return view('core::users.edit', compact(['userData', 'mainDepartments', 'parentDepartments', 'directDepartments', 'rolesData']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$userID)
    {
        $userData = User::findOrFail($userID);

        $request->validate([
            // 'main_department_id'   => 'required|integer|exists:'. Department::table() .',id',
            // 'parent_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'direct_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'national_id'          => 'required|national_id|unique:'. User::table() . ',national_id,' . $userData->id,
            'name'                 => 'required|filter_string|string',
            'phone_number'         => 'required|phone_number|unique:'. User::table() . ',phone_number,' . $userData->id,
            'email'                => 'required|email|gov_email|unique:'. User::table() . ',email,' . $userData->id,
            'job_role_id'          => 'required|integer|exists:'. Group::table() .',id',
        ]);

        $userData = $userData->update($request);

        if(!$userData) {

            if($this->isApiCall) {
                return response()->json(__('core::.users.userNotUpdated'), 422);
            }
            else {
                session()->flash('alert-danger', __('core::.users.userNotUpdated')); 
                return redirect()->back()->withInput($request->all());
            }

        }

        if($this->isApiCall) {
            return response()->json(__('core::.users.userUpdated'), 200);
        }
        
        session()->flash('alert-success', __('core::.users.userUpdated')); 
        return redirect()->route('core.users.index');
    }
        

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $usersData = User::search($request->input('search'))->select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->paginate(10);
        return response()->json($usersData, 200);
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
