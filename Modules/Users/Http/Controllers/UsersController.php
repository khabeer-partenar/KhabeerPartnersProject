<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Employee;
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
            $employees = Employee::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin', 'job_role_id', 'direct_department_id')->with('jobRole', 'directDepartment');

            if((int)$request->employee_id && $request->employee_id > 0) {
                $employees = $employees->where('id', $request->employee_id);
            }

            if((int)$request->job_role_id && $request->job_role_id > 0) {
                $employees = $employees->where('job_role_id', $request->job_role_id);
            }

            if((int)$request->direct_department_id && $request->direct_department_id > 0) {
                $employees = $employees->where('direct_department_id', $request->direct_department_id);
            }

            return Datatables::of($employees)
               ->addColumn('deptname', function ($employee) {
                   return @$employee->directDepartment->name;
               })
               ->addColumn('job_role', function ($employee) {
                   return @$employee->jobRole->name;
               })
               ->addColumn('action', function ($employee) {
                    return view('users::users.actions', compact('employee'));
               })
               ->toJson();
        } else {

            $userDatatableURL        = route('users.index') . '?employee_id=' . $request->employee_id . '&job_role_id=' . $request->job_role_id . '&direct_department_id=' . $request->direct_department_id;
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
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');
        return view('users::users.create', compact(['departmentsDataForForms', 'rolesData']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SaveUserRequest $request)
    {
        $userData = Employee::createNewUser($request);        
        session()->flash('alert-success', __('users.userCreated')); 
        return redirect()->route('users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, $userID)
    {
        $userData                = Employee::findOrFail($userID);
        $departmentsDataForForms = $userData->getDepartmentsDataForForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');
        $secretariesUsersData    = [];

        if($userData->hasAdvisorsGroup()) {
            $secretariesUsersData = $userData->secretaries()->with('secretaryData')->get();
        }

        return view('users::users.show', compact(['userData', 'departmentsDataForForms', 'rolesData', 'secretariesUsersData']));
    }

    public function edit(Request $request, $userID)
    {
        $userData                = Employee::findOrFail($userID);
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');

        return view('users::users.edit', compact(['userData', 'departmentsDataForForms', 'rolesData']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $userID)
    {
        // still working on it
        exit;
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
        $usersData = User::where('name', 'LIKE', '%'. $request->input('search') .'%')->select('id', 'name as text')->get();
        return response()->json(['results' => $usersData], 200);
    }

    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, $userID) 
    {
        $userData = User::findOrFail($userID);
        $userData->is_super_admin = !$userData->is_super_admin;

        if(User::where('is_super_admin', 1)->count() == 1 && $userData->is_super_admin == 0) {
            return back();
        }

        $userData->save();

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('users.index');
    }

    /**
     * search in users.
     */
    public function groups(Request $request)
    {
        $groups = Group::select('id', 'name')->get();
        return $groups;
    }


    /**
     * secretaries of user
     */
    public function secretaries(Request $request, $userID) 
    {
        $userData = User::with('secretaries', 'secretaries.secretaryData', 'secretaries.secretaryData.directDepartment', 'secretaries.secretaryData.jobRole')->findOrFail($userID);
        if(!$request->wantsJson() || !$request->ajax() || !$userData->hasAdvisorsGroup()) {
            return redirect()->route('users.show', $userData->id);
        }

        return Datatables::of($userData->secretaries)
                ->addColumn('name', function ($user) {
                    return @$user->secretaryData->name;
                })
                ->addColumn('deptname', function ($user) {
                    return @$user->secretaryData->directDepartment->name;
                })
                ->addColumn('email', function ($user) {
                    return @$user->secretaryData->email;
                })
                ->addColumn('phone_number', function ($user) {
                    return @$user->secretaryData->phone_number;
                })
                ->addColumn('job_role', function ($user) {
                    return @$user->secretaryData->jobRole->name;
                })
                ->toJson();
    }


    /**
     * edit secretaries of user
     */
    public function editSecretaries(Request $request, $userID) 
    {
        $userData = User::with('secretaries')->findOrFail($userID);
        if(!$userData->hasAdvisorsGroup()) {
            return redirect()->route('users.show', $userData->id);
        }

        $secretariesIDs   = $userData->secretaries->pluck('secretary_user_id');
        $secretariesUsers = Group::secretariesUsers()->pluck('name', 'id');
        return view('users::users.secretaries.edit', compact(['userData', 'secretariesIDs', 'secretariesUsers']));
    }

    /**
     * update secretaries of user
     */
    public function updateSecretaries(Request $request, $userID) 
    {
        $userData = User::with('secretaries')->findOrFail($userID);
        if(!$userData->hasAdvisorsGroup()) {
            return redirect()->route('users.show', $userData->id);
        }

        $userData->syncSecretariesUsers($request->secretaries_ids);
        return redirect()->route('users.show', $userData->id);
    }

}
