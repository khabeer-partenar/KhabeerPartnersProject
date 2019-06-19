<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
<<<<<<< HEAD

class UsersController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
=======
use Yajra\Datatables\Datatables;
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
            $users = User::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin');

            return Datatables::of($users)
               ->addColumn('action', function ($user) {
                   return '
                    <a href="'. route('users.upgrate_to_super_admin', $user->id) .'" class="btn btn-xs btn-'. ($user->is_super_admin == 1 ? 'danger' : 'primary') .' confirm-message">
                        <i class="fa fa-key"></i> Admin
                    </a>

                    <a href="'. route('users.edit', $user->id) .'" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i> تعديل المتسخدم
                    </a>

                    <a href="'. route('users.destroy-confirmation', $user->id) .'" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> تعطيل المستخدم
                    </a>

                    ';
               })
               ->make(true);
        } else {
            return view('users::users.index');
        }
    }

    /**
     * Show the form for creating a New resource.
>>>>>>> origin/master
     * @return Response
     */
    public function create()
    {
<<<<<<< HEAD
        return view('users::create');
=======
        $mainDepartments   = Department::mainDepartments()->select('name', 'id')->get();
        $parentDepartments = Department::parentDepartments($mainDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments = Department::directDepartments($parentDepartments[0]->id)->select('name', 'id')->get();
        $rolesData         = Group::pluck('name', 'id')->prepend('', '');

        // pluck query to be valid in laravelcollective
        $mainDepartments   = $mainDepartments->pluck('name', 'id');
        $parentDepartments = $parentDepartments->pluck('name', 'id');
        $directDepartments = $directDepartments->pluck('name', 'id')->prepend('', '');

        return view('users::users.create', compact(['mainDepartments', 'parentDepartments', 'directDepartments', 'rolesData']));
>>>>>>> origin/master
    }

    /**
     * Store a newly created resource in storage.
<<<<<<< HEAD
     * @param Request $request
=======
     * @param  Request $request
>>>>>>> origin/master
     * @return Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        //
=======
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
                return response()->json(__('users.userNotCreated'), 422);
            }
            else {
                session()->flash('alert-danger', __('users.userNotCreated')); 
                return redirect()->route('users.index');
            }

        }

        if($this->isApiCall) {
            return response()->json(__('users.userCreated'), 200);
        }
        
        session()->flash('alert-success', __('users.userCreated')); 
        return redirect()->route('users.index');
>>>>>>> origin/master
    }

    /**
     * Show the specified resource.
<<<<<<< HEAD
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('users::show');
=======
     * @return Response
     */
    public function show(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        return view('users::users.show', compact('userData'));
>>>>>>> origin/master
    }

    /**
     * Show the form for editing the specified resource.
<<<<<<< HEAD
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('users::edit');
=======
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

        return view('users::users.edit', compact(['userData', 'mainDepartments', 'parentDepartments', 'directDepartments', 'rolesData']));
>>>>>>> origin/master
    }

    /**
     * Update the specified resource in storage.
<<<<<<< HEAD
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
=======
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
                return response()->json(__('users::users.userNotUpdated'), 422);
            }
            else {
                session()->flash('alert-danger', __('users::users.userNotUpdated')); 
                return redirect()->back()->withInput($request->all());
            }

        }

        if($this->isApiCall) {
            return response()->json(__('users::users.userUpdated'), 200);
        }
        
        session()->flash('alert-success', __('users::users.userUpdated')); 
        return redirect()->route('users.index');
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


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $userID)
    {
        $userData = User::findOrFail($userID);
        $userData->delete();

        return response()->json(null, 200);
>>>>>>> origin/master
    }
}
