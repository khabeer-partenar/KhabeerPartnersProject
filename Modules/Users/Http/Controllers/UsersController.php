<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Http\Requests\UpdateSecretariesRequest;
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
                    return view('users::users.actions', compact('user'));
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
        User::createNewUser($request);        
        session()->flash('alert-success', __('users.userCreated')); 
        return redirect()->route('users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, User $user)
    {
        $departmentsDataForForms = $user->getDepartmentsDataForForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');
        $secretariesUsersData    = [];

        if($user->hasAdvisorsGroup()) {
            $secretariesUsersData = $user->secretaries()->with('secretaryData')->get();
        }

        return view('users::users.show', compact(['user', 'departmentsDataForForms', 'rolesData', 'secretariesUsersData']));
    }

    public function edit(Request $request, User $user)
    {
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');

        return view('users::users.edit', compact(['user', 'departmentsDataForForms', 'rolesData']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->updateUser($request);
        session()->flash('alert-success', __('users::users.userUpdated')); 
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
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
    public function upgrateToSuperAdmin(Request $request, User $user)
    {
        $user->is_super_admin = !$user->is_super_admin;

        if(User::where('is_super_admin', 1)->count() == 1 && $user->is_super_admin == 0) {
            return back();
        }

        $user->save();

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
    public function secretaries(Request $request, User $user)
    {
        if(!$request->wantsJson() || !$request->ajax() || !$user->hasAdvisorsGroup()) {
            return redirect()->route('users.index');
        }

        return Datatables::of($user->secretaries)
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
    public function editSecretaries(Request $request, User $user)
    {
        if(!$user->hasAdvisorsGroup()) {
            return redirect()->route('users.index');
        }

        $secretariesIDs   = $user->secretaries->pluck('secretary_user_id');
        $secretariesUsers = Group::secretariesUsers()->pluck('name', 'id');
        return view('users::users.secretaries.edit', compact(['user', 'secretariesIDs', 'secretariesUsers']));
    }

    /**
     * update secretaries of user
     */
    public function updateSecretaries(UpdateSecretariesRequest $request, User $user)
    {
        if(!$user->hasAdvisorsGroup()) {
            return redirect()->route('users.index');
        }

        $user->syncSecretariesData($request->secretaries_ids);
        session()->flash('alert-success', __('users.secretariesUpdated')); 
        return view('users::users.edit-secretaries', compact(['user']));
    }

}
