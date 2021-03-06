<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Illuminate\Support\Facades\Notification;
use Modules\Users\Notifications\NewUserAdded;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveEmployeeRequest;
use Modules\Users\Http\Requests\UpdateEmployeeRequest;
use Modules\Users\Http\Requests\UpdateSecretariesRequest;
use Modules\Users\Entities\Employee;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;

class EmployeeController extends UserBaseController
{

    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        $employeesData      = Employee::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin', 'job_role_id', 'direct_department_id')->with('jobRole', 'directDepartment')->search($request)->paginate(10);
        $employeesOptions   = [0 => __('messages.choose_option')];
        $directDepartments  = Department::where('type', 3)->pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        $rolesData          = Group::employeeRoles()->pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        return view('users::employees.index', compact('employeesData', 'employeesOptions', 'directDepartments', 'rolesData'));
    }

    /**
     * Show the form for creating a New resource.
     * @return Response
     */
    public function create()
    {
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::employeeRoles()->pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        return view('users::employees.create', compact(['departmentsDataForForms', 'rolesData']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SaveEmployeeRequest $request)
    {
        $employee = Employee::createNewEmployee($request);
        $employee->log('create_employee');
        Notification::send($employee, new NewUserAdded($employee));
        session()->flash('alert-success', __('users::employees.userCreated'));
        return redirect()->route('employees.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, Employee $employee)
    {
        $departmentsDataForForms = $employee->getDepartmentsDataForForms();
        return view('users::employees.show', compact(['employee', 'departmentsDataForForms']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function edit(Request $request, Employee $employee)
    {
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::employeeRoles()->pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        return view('users::employees.edit', compact(['employee', 'departmentsDataForForms', 'rolesData']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->updateEmployee($request);
        $employee->log('update_employee');
        session()->flash('alert-success', __('users::employees.userUpdated'));
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();
        $employee->log('delete_employee');
        return response()->json(['msg' => __('users::employees.deleted')]);
    }

    /**
     * search in employees by name
     */
    public function searchByName(Request $request)
    {
        $employeesData = Employee::where('name', 'LIKE', '%'. $request->input('search') .'%')->select('id', 'name as text')->get();
        return response()->json(['results' => $employeesData], 200);
    }

    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, Employee $employee)
    {
        $employee->is_super_admin = !$employee->is_super_admin;
        if(Employee::where('is_super_admin', 1)->count() == 1 && $employee->is_super_admin == 0) {
            return back();
        }

        $employee->save();
        $employee->log('update_employee_to_super_admin');
        session()->flash('alert-success', __('messages.updatedـsuccessfully'));
        return redirect()->route('employees.index');
    }
}
