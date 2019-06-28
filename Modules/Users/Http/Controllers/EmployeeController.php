<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\SaveEmployeeRequest;
use Modules\Users\Http\Requests\UpdateEmployeeRequest;
use Modules\Users\Http\Requests\UpdateSecretariesRequest;
use Modules\Users\Entities\Employee;
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
            $employees = Employee::select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin', 'job_role_id', 'direct_department_id')
                                ->with('jobRole', 'directDepartment')
                                ->search($request);

            return Datatables::of($employees)
               ->addColumn('deptname', function ($employee) {
                   return @$employee->directDepartment->name;
               })
               ->addColumn('job_role', function ($employee) {
                   return @$employee->jobRole->name;
               })
               ->addColumn('contact_options', function($employee) {
                    $data = [$employee->phone_number, $employee->email];
                    return view('users::employees.commas_separated_data', compact('data'));
                })
               ->addColumn('action', function ($employee) {
                    return view('users::employees.actions', compact('employee'));
               })
               ->rawColumns(['action', 'contact_options'])
               ->toJson();
        }
        
        $employeesData      = [];
        if((int)$request->employee_id && $request->employee_id > 0) {
            $employeesData = [$request->employee_id => optional(Employee::where('id', $request->employee_id)->first())->name];
        }

        $directDepartments  = Department::where('type', 3)->pluck('name', 'id')->prepend('', '');
        $rolesData          = Group::pluck('name', 'id')->prepend('', '');
        return view('users::employees.index', compact('employeesData', 'directDepartments', 'rolesData'));
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
        $rolesData               = Group::pluck('name', 'id')->prepend('', '');
        return view('users::employees.show', compact(['employee', 'departmentsDataForForms', 'rolesData']));
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
        return response()->json(['msg' => __('users::employees.deleted')]);
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
                ->addColumn('contact_options', function($employee) {
                    $data = [$employee->secretaryData->phone_number, $employee->secretaryData->email];
                    return view('users::employees.commas_separated_data', compact('data'));
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

        $secretariesIDs       = $employee->secretaries->pluck('secretary_user_id');
        $secretariesEmployees = Group::secretariesEmployees()->pluck('name', 'id');
        return view('users::employees.secretaries.edit', compact(['employee', 'secretariesIDs', 'secretariesEmployees']));
    }

    /**
     * update secretaries of employee
     */
    public function updateSecretaries(UpdateSecretariesRequest $request, Employee $employee)
    {
        if(!$employee->hasAdvisorsGroup()) {
            return redirect()->route('employees.show', $employee);
        }

        $employee->syncSecretariesEmployees($request->secretaries_ids);
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

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('employees.index');
    }
}
