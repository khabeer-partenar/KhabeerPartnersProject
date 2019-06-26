<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveEmployeeRequest;
use Modules\Users\Http\Requests\UpdateEmployeeRequest;
use Modules\Users\Http\Requests\UpdateSecretariesRequest;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Employee;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;

class EmployeeController extends UserBaseController
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
                    return view('users::employees.actions', compact('employee'));
               })
               ->toJson();
        } else {

            $userDatatableURL        = route('employees.index') . '?employee_id=' . $request->employee_id . '&job_role_id=' . $request->job_role_id . '&direct_department_id=' . $request->direct_department_id;
            $directDepartments       = Department::where('type', 3)->pluck('name', 'id')->prepend('', '');
            $rolesData               = Group::pluck('name', 'id')->prepend('', '');

            return view('users::employees.index', compact('userDatatableURL', 'directDepartments', 'rolesData'));
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
        return view('users::employees.create', compact(['departmentsDataForForms', 'rolesData']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SaveEmployeeRequest $request)
    {
        Employee::createNewEmployee($request);        
        session()->flash('alert-success', __('users.userCreated')); 
        return redirect()->route('employees.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request, Employee $employee)
    {
        $departmentsDataForForms = $employee->getDepartmentsDataForForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');
        $secretariesUsersData    = [];

        if($employee->hasAdvisorsGroup()) {
            $secretariesUsersData = $employee->secretaries()->with('secretaryData')->get();
        }

        return view('users::employees.show', compact(['employee', 'departmentsDataForForms', 'rolesData', 'secretariesUsersData']));
    }

    public function edit(Request $request, Employee $employee)
    {
        $departmentsDataForForms = Department::getDepartmentsDataForUsersForms();
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');

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
        session()->flash('alert-success', __('users::employees.userDeleted')); 
        return redirect()->route('employees.index');
    }

    /**
     * secretaries of employee
     */
    public function secretaries(Request $request, Employee $employee)
    {
        if(!$request->wantsJson() || !$request->ajax() || !$employee->hasAdvisorsGroup()) {
            return redirect()->route('employees.index');
        }

        return Datatables::of($employee->secretaries)
                ->addColumn('name', function ($employee) {
                    return @$employee->secretaryData->name;
                })
                ->addColumn('deptname', function ($employee) {
                    return @$employee->secretaryData->directDepartment->name;
                })
                ->addColumn('email', function ($employee) {
                    return @$user->secretaryData->email;
                })
                ->addColumn('phone_number', function ($employee) {
                    return @$employee->secretaryData->phone_number;
                })
                ->addColumn('job_role', function ($employee) {
                    return @$employee->secretaryData->jobRole->name;
                })
                ->toJson();
    }


    /**
     * edit secretaries of employee
     */
    public function editSecretaries(Request $request, Employee $employee)
    {
        if(!$employee->hasAdvisorsGroup()) {
            return redirect()->route('users.index');
        }

        $secretariesIDs   = $employee->secretaries->pluck('secretary_user_id');
        $secretariesUsers = Group::secretariesUsers()->pluck('name', 'id');
        return view('users::employees.secretaries.edit', compact(['employee', 'secretariesIDs', 'secretariesUsers']));
    }

    /**
     * update secretaries of employee
     */
    public function updateSecretaries(UpdateSecretariesRequest $request, Employee $employee)
    {
        if(!$employee->hasAdvisorsGroup()) {
            return redirect()->route('employees.show', $employee);
        }

        $employee->syncSecretariesUsers($request->secretaries_ids);
        session()->flash('alert-success', __('users::employees.secretariesUpdated')); 
        return redirect()->route('employees.show', $employee);
    }


    /**
     * search in employees by name
     */
    public function searchByName(Request $request)
    {
        $employeesData = Employee::where('name', 'LIKE', '%'. $request->input('search') .'%')->select('id', 'name as text')->get();
        return response()->json(['results' => $employeesData], 200);
    }
}
