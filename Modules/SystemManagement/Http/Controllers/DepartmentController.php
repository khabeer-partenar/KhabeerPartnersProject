<?php

namespace Modules\SystemManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\SystemManagement\Entities\Department;

use Modules\SystemManagement\Http\Requests\SaveDepartmentTypeRequest;
use Modules\SystemManagement\Http\Requests\UpdateDepartmentTypeRequest;
use Modules\SystemManagement\Http\Requests\SaveDepartmentManagementRequest;
use Modules\SystemManagement\Http\Requests\UpdateDepartmentManagementRequest;

class DepartmentController extends UserBaseController
{

    /**
     * Search in departments
     * @return Response
     */
    public function search(Request $request, $type)
    {
        $departmentsData = Department::ajaxSearch($type, $request);
        return response()->json(['results' => $departmentsData], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, Department $department)
    {
        if(!$department->can_deleted) {
            return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentCanNotDeleted')], 423);
        }

        if($department->childrens->count()) {
            return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentCanNotDeletedCuzChildrens')], 423);
        }

        if($department->users('main')->count() || $department->users('parent')->count() || $department->users('direct')->count()) {
            return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentCanNotDeletedCuzUsers')], 423);
        }

        $department->delete();
        return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentDeleted')], 200);
    }


    /**
     * 
     * departments types functions
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function departmentsTypes(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {

            $departmentsData = Department::getDepartmentsData('parent')
                                            ->search($request);


            return Datatables::of($departmentsData)
               ->addColumn('action', function ($departmentData) {
                    return view('systemmanagement::departmentsTypes.actions', compact('departmentData'));
               })
               ->toJson();
        }

        $parentDepartmentsData = Department::getDepartmentsData('parent')->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsTypes.index', compact('parentDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsTypesCreate()
    {
        return view('systemmanagement::departmentsTypes.create');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsTypesStore(SaveDepartmentTypeRequest $request)
    {
        $data = ['name' => $request->name, 'type' => 1];
        Department::createNewDepartment($data);
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeCreated')); 
        return redirect()->route('system-management.departments-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Department $department
     * @return Response
     * @internal param int $id
     */
    public function departmentsTypesEdit(Request $request, Department $department)
    {
        return view('systemmanagement::departmentsTypes.edit', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsTypesUpdate(UpdateDepartmentTypeRequest $request, Department $department)
    {
        $department->update($request->only('name'));
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeUpdated')); 
        return redirect()->route('system-management.departments-types.index');
    }


    /**
     * 
     * departments management functions
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function departmentsManagement(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {

            $departmentsData = Department::getDepartmentsData('main')
                                            ->with('parent')
                                            ->with('referenceDepartment')
                                            ->search($request);


            return Datatables::of($departmentsData)
                ->addColumn('parent_name', function ($departmentData) {
                    return @$departmentData->parent->name;
                })
                ->addColumn('reference_name', function ($departmentData) {
                    return (!$departmentData->is_reference ? @$departmentData->referenceDepartment->name : '---');
                })
                ->addColumn('action', function ($departmentData) {
                    return view('systemmanagement::departmentsManagement.actions', compact('departmentData'));
                })
                ->toJson();
        }

        $parentDepartmentsData = Department::getDepartmentsData('parent')->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $mainDepartmentsData   = Department::getParentDepartments($request->parent_department_id);
        return view('systemmanagement::departmentsManagement.index', compact('parentDepartmentsData', 'mainDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementCreate()
    {
        $parentDepartmentsData = Department::getDepartmentsData('parent')->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $mainDepartmentsData   = Department::getDepartmentsData('main')->where('is_reference', 1)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsManagement.create', compact('parentDepartmentsData', 'mainDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementStore(SaveDepartmentManagementRequest $request)
    {
        $data = ['parent_id' => $request->main_department_id, 'name' => $request->name, 'type' => 2, 'telephone' => $request->telephone, 'address' => $request->address, 'email' => $request->email, 'is_reference' => $request->is_reference, 'reference_id' => $request->reference_id];
        Department::createNewDepartment($data);
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeCreated')); 
        return redirect()->route('system-management.departments-management.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Department $department
     * @return Response
     * @internal param int $id
     */
    public function departmentsManagementEdit(Request $request, Department $department)
    {
        $parentDepartmentsData = Department::getDepartmentsData('parent')->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $mainDepartmentsData   = Department::getDepartmentsData('main')->where('is_reference', 1)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsManagement.edit', compact('department', 'parentDepartmentsData', 'mainDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementUpdate(UpdateDepartmentManagementRequest $request, Department $department)
    {
        $data = ['name' => $request->name, 'type' => 2, 'telephone' => $request->telephone, 'address' => $request->address, 'email' => $request->email, 'is_reference' => $request->is_reference, 'reference_id' => $request->reference_id];
        $department->updateDepartment($data);
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeUpdated')); 
        return redirect()->route('system-management.departments-management.index');
    }
}
