<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Http\Requests\UpdateSecretariesRequest;
use Modules\Users\Entities\Employee;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;

class AssignCommitteController extends UserBaseController
{

    /**
     * search
     */
    public function search(Request $request, $groupID, $columnType)
    {
        $columnIDType   = 'id';
        $columnTextType = 'name';

        switch($columnType) {
            case 'name':
                $columnIDType   = 'id';
                $columnTextType = 'name';
            break;
            case 'email':
                $columnIDType   = 'id';
                $columnTextType = 'email';
            break;
            case 'national_id':
                $columnIDType   = 'national_id';
                $columnTextType = 'national_id';
            break;
            default:
                $columnIDType   = 'id';
                $columnTextType = 'name';
        }

        $employeesData = Employee::where('job_role_id', $groupID)->where($columnTextType, 'LIKE', '%'. $request->input('search') .'%')
                                ->select($columnIDType .' as id', $columnTextType . ' as text')->get();
        return response()->json(['results' => $employeesData], 200);
    }

    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        $secretaryGroupId = optional(Group::findByKey('secretary'))->id;

        if ($request->wantsJson() || $request->ajax()) {
            $employees = Employee::select('id', 'name', 'national_id', 'email', 'phone_number', 'job_role_id', 'direct_department_id')
                                ->where('job_role_id', $secretaryGroupId)
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
                    return view('users::employees.assign_committees.actions', compact('employee'));
               })
               ->rawColumns(['action', 'contact_options'])
               ->toJson();
        }

        $employeesIdsData = $employeesNationalIdData = $employeesEmailData = [0 => __('messages.choose_option')];
        return view('users::employees.assign_committees.index', compact('secretaryGroupId', 'employeesIdsData', 'employeesNationalIdData', 'employeesEmailData'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param Employee $employee
     * @return Response
     * @internal param int $id
     */
    public function edit(Request $request, Employee $employee)
    {
        if(!$employee->hasSecretariesGroup()) {
            return redirect()->route('employees.assign_committees.index');
        }
        $advisorsIDs       = $employee->advisors()->pluck('users.id');
        $advisorsEmployees = Group::advisorsUsers()->pluck('name', 'id');
        return view('users::employees.assign_committees.edit', compact('employee', 'advisorsIDs', 'advisorsEmployees'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateSecretariesRequest $request, Employee $employee)
    {
        if(!$employee->hasSecretariesGroup()) {
            return redirect()->route('employees.assign_committees.index');
        }
        $employee->advisors()->sync($request->advisors_ids);
        $employee->log('update_employee_advisors', json_encode($request->advisors_ids));
        session()->flash('alert-success', __('users::employees.assignCommittees.advisorsUpdated'));
        return redirect()->route('employees.assign_committees.index');
    }

}
