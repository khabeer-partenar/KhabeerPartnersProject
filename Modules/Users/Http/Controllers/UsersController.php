<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;

class UsersController extends UserBaseController
{
    
    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $users = User::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin', 'job_role_id', 'direct_department_id')->with('jobRole', 'directDepartment');

            if((int)$request->user_id && $request->user_id > 0) {
                $users = $users->where('id', $request->user_id);
            }

            if((int)$request->job_role_id && $request->job_role_id > 0) {
                $users = $users->where('job_role_id', $request->job_role_id);
            }

            if((int)$request->direct_department_id && $request->direct_department_id > 0) {
                $users = $users->where('direct_department_id', $request->direct_department_id);
            }

            return Datatables::of($users)
               ->addColumn('deptname', function ($user) {
                return @$user->directDepartment->name;
               })
               ->addColumn('job_role', function ($user) {
                return @$user->jobRole->name;
               })
               ->addColumn('action', function ($user) {
                   return '
                    <a href="'. route('users.upgrate_to_super_admin', $user->id) .'" class="btn btn-xs btn-'. ($user->is_super_admin == 1 ? 'danger' : 'primary') .' confirm-message">
                        <i class="fa fa-key"></i> Admin
                    </a>

                    <a href="'. route('users.edit', $user->id) .'" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i> '. __('users::users.edit_action') .'
                    </a>

                    <a href="'. route('users.destroy-confirmation', $user->id) .'" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> '. __('users::users.delete_action') .'
                    </a>

                    ';
               })
               ->toJson();
        } else {

            $userDatatableURL        = route('users.index') . '?user_id=' . $request->user_id . '&job_role_id=' . $request->job_role_id . '&direct_department_id=' . $request->direct_department_id;
            $directDepartments       = Department::where('type', 2)->pluck('name', 'id')->prepend('', '');
            $rolesData               = Group::pluck('name', 'id')->prepend('', '');

            return view('users::users.index', compact('userDatatableURL', 'directDepartments', 'rolesData'));
        }
    }

    /**
     * Show the form for creating a New resource.
     * @return Response
     */
    public function create()
    {
        $staffsDepartments       = Department::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartments = Department::staffExpertsDepartments($staffsDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments       = Department::directDepartments($staffExpertsDepartments[0]->id)->select('name', 'id')->get();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');

        // pluck query to be valid in laravelcollective
        $staffsDepartments       = $staffsDepartments->pluck('name', 'id');
        $staffExpertsDepartments = $staffExpertsDepartments->pluck('name', 'id');
        $directDepartments       = $directDepartments->pluck('name', 'id')->prepend('', '');

        return view('users::users.create', compact(['staffsDepartments', 'staffExpertsDepartments', 'directDepartments', 'rolesData']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SaveUserRequest $request)
    {
        $userData = User::createNewUser($request);        
        session()->flash('alert-success', __('users.userCreated')); 
        return redirect()->route('users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        return view('users::users.show', compact('userData'));
    }

    public function edit(Request $request, $userID)
    {
        $userData          = User::findOrFail($userID);

        $staffsDepartments       = Department::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartments = Department::staffExpertsDepartments($staffsDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments       = Department::directDepartments($staffExpertsDepartments[0]->id)->select('name', 'id')->get();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');

        // pluck query to be valid in laravelcollective
        $staffsDepartments       = $staffsDepartments->pluck('name', 'id');
        $staffExpertsDepartments = $staffExpertsDepartments->pluck('name', 'id');
        $directDepartments       = $directDepartments->pluck('name', 'id')->prepend('', '');

        return view('users::users.edit', compact(['userData', 'staffsDepartments', 'staffExpertsDepartments', 'directDepartments', 'rolesData']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);

        $request->validate([
            'direct_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'national_id'          => 'required|unique:'. User::table() . ',national_id,' . $userData->id,
            'name'                 => 'required|string',
            'phone_number'         => 'required|unique:'. User::table() . ',phone_number,' . $userData->id,
            'email'                => 'required|email|unique:'. User::table() . ',email,' . $userData->id,
            'job_role_id'          => 'required|integer|exists:'. Group::table() .',id',
        ]);

        $userData = $userData->updateUser($request);
        session()->flash('alert-success', __('users::users.userUpdated')); 

        return redirect()->route('users.index');
    }


    /**
     * Confirm the delete of user
     */
    public function destroyConfirmation(Request $request, $userID) 
    {
        $userData = User::findOrFail($userID);
        return view('users::users.destroy', compact(['userData']));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        $userData->delete();
        session()->flash('alert-success', __('users::users.userDeleted')); 
        return redirect()->route('users.index');
    }
        

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $usersData = User::search($request->input('search'))->select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->get();
        return response()->json($usersData, 200);
    }


    /**
     * search in users by name
     */
    public function searchByName(Request $request)
    {
        $usersData = [];
        
        if($request->input('search')) {
            $usersData = User::where('name', 'LIKE', '%'. $request->input('search') .'%')->select('id', 'name as text')->get();
        }

        return response()->json(['results' => $usersData], 200);
    }

    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, $userID) 
    {
        if(User::where('is_super_admin')->count() == 1) {
            return back();
        }

        $userData = User::findOrFail($userID);
        $userData->is_super_admin = !$userData->is_super_admin;
        $userData->save();

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('users.index');
    }

    /**
     * search in users
     */
    public function groups(Request $request)
    {
        $groups = Group::select('id', 'name')->get();
        return $groups;
    }
}
