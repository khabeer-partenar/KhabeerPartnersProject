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
use Modules\SystemManagement\Http\Requests\SaveDepartmentAuthoritiesRequest;
use Modules\SystemManagement\Http\Requests\UpdateDepartmentAuthoritiesRequest;

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
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function loadDepartmentsByParentId(Request $request)
    {
        $departments = Department::getDepartmentsWithRef($request->get('parentId'));
        return response()->json($departments);
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

        if($department->childrens->count() || $department->referenceDepartment) {
            return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentCanNotDeletedCuzChildrens')], 423);
        }

        if($department->users('main')->count() || $department->users('parent')->count() || $department->users('direct')->count()) {
            return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentCanNotDeletedCuzUsers')], 423);
        }

        $department->log('delete_department');
        $department->delete();
        return response()->json(['msg' => __('systemmanagement::systemmanagement.departmentDeleted')], 200);
    }


    /**
     * update current order of dep
     * @return Response
     */
    public function updateOrder(Request $request, Department $department)
    {
        if(!in_array($request->action, ['up', 'down'])) {
            return response()->json(['msg' => 'not allowed'], 423);
        }

        $newOrder = $department->order;
        switch($request->action) {
            case 'up':
                $newOrder = $newOrder-1;
            break;
            default:
                $newOrder = $newOrder+1;
        }

        // change order of dept that have the new order
        $departmentWithNewOrder = Department::where('type', $department->type)->where('order', $newOrder)->first();
        if($departmentWithNewOrder) {
                $departmentWithNewOrder->update([
                'order' => $department->order,
            ]);
        
            // update order of current dept
            $department->update(['order' => $newOrder]);
            $department->log('update_department_order');

            return response()->json(['new_order' => $newOrder], 200);
        }

        return response()->json(['msg' => 'not allowed'], 423);
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

            $departmentsData = Department::getDepartmentsData(Department::mainDepartment)
                                            ->search($request);


            return Datatables::of($departmentsData)
               ->addColumn('action', function ($departmentData) {
                    return view('systemmanagement::departmentsTypes.actions', compact('departmentData'));
               })
               ->toJson();
        }

        $mainDepartmentsData = Department::getDepartmentsData(Department::mainDepartment)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsTypes.index', compact('mainDepartmentsData'));
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
        $department = Department::createNewDepartment($data);
        $department->log('create_department');

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
        $department->log('update_department');

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

            $departmentsData = Department::getDepartmentsData(Department::parentDepartment)
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

        $mainDepartmentsData   = Department::getDepartmentsData(Department::mainDepartment)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $parentDepartmentsData = Department::getParentDepartments($request->parent_department_id);
        return view('systemmanagement::departmentsManagement.index', compact('mainDepartmentsData', 'parentDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementCreate()
    {
        $mainDepartmentsData   = Department::getDepartmentsData(Department::mainDepartment)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $parentDepartmentsData = Department::getDepartmentsData(Department::parentDepartment)->where('is_reference', 1)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsManagement.create', compact('mainDepartmentsData', 'parentDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementStore(SaveDepartmentManagementRequest $request)
    {
        $data = ['parent_id' => $request->main_department_id, 'name' => $request->name, 'type' => 2, 'telephone' => $request->telephone, 'address' => $request->address, 'email' => $request->email, 'is_reference' => $request->is_reference, 'reference_id' => $request->reference_id];
        $department = Department::createNewDepartment($data);
        $department->log('create_department');
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
        $mainDepartmentsData   = Department::getDepartmentsData(Department::mainDepartment)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        $parentDepartmentsData = Department::getDepartmentsData(Department::parentDepartment)->where('is_reference', 1)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsManagement.edit', compact('department', 'mainDepartmentsData', 'parentDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsManagementUpdate(UpdateDepartmentManagementRequest $request, Department $department)
    {
        $data = ['name' => $request->name, 'type' => 2, 'telephone' => $request->telephone, 'address' => $request->address, 'email' => $request->email];
        $department->updateDepartment($data);
        $department->log('update_department');
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeUpdated')); 
        return redirect()->route('system-management.departments-management.index');
    }


    /**
     * 
     * departments authorities functions
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function departmentsAuthorities(Request $request)
    {
        $staffsDepartmentId       = Department::staffsDepartments()->select('id')->first()->id;
        $staffExpertsDepartmentId = Department::staffExpertsDepartments($staffsDepartmentId)->select('id')->first()->id;

        if ($request->wantsJson() || $request->ajax()) {

            $departmentsData = Department::getDepartmentsData(Department::directDepartment)
                                            ->where('parent_id', $staffExpertsDepartmentId)
                                            ->search($request);


            return Datatables::of($departmentsData)
                ->addColumn('action', function ($departmentData) {
                    return view('systemmanagement::departmentsAuthorities.actions', compact('departmentData'));
                })
                ->toJson();
        }

        $directDepartmentsData = Department::getDepartmentsData(Department::directDepartment)->where('parent_id', $staffExpertsDepartmentId)->pluck('name', 'id')->prepend(__('users::departments.choose a department'), '');
        return view('systemmanagement::departmentsAuthorities.index', compact('directDepartmentsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsAuthoritiesCreate(Request $request)
    {
        $staffsDepartment       = Department::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartment = Department::staffExpertsDepartments($staffsDepartment[0]->id)->pluck('name', 'id');
        $staffsDepartment = $staffsDepartment->pluck('name', 'id');
        return view('systemmanagement::departmentsAuthorities.create', compact('staffsDepartment', 'staffExpertsDepartment'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsAuthoritiesStore(SaveDepartmentAuthoritiesRequest $request)
    {
        $staffsDepartmentId       = Department::staffsDepartments()->select('id')->first()->id;
        $staffExpertsDepartmentId = Department::staffExpertsDepartments($staffsDepartmentId)->select('id')->first()->id;

        $data = ['parent_id' => $staffExpertsDepartmentId, 'name' => $request->department_name, 'type' => 3, 'direct_manager_id' => $request->direct_manager_id];
        $department = Department::createNewDepartment($data);
        $department->log('create_department');
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentAuthoritiesCreated')); 
        return redirect()->route('system-management.departments-authorities.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Department $department
     * @return Response
     * @internal param int $id
     */
    public function departmentsAuthoritiesEdit(Request $request, Department $department)
    {
        $staffsDepartment       = Department::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartment = Department::staffExpertsDepartments($staffsDepartment[0]->id)->pluck('name', 'id');
        $staffsDepartment = $staffsDepartment->pluck('name', 'id');
        $directManager = $department->directManager()->pluck('name', 'id');
        return view('systemmanagement::departmentsAuthorities.edit', compact('department', 'staffsDepartment', 'staffExpertsDepartment', 'directManager'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function departmentsAuthoritiesUpdate(UpdateDepartmentAuthoritiesRequest $request, Department $department)
    {
        $data = ['name' => $request->department_name, 'direct_manager_id' => $request->direct_manager_id];
        $department->updateDepartment($data);
        $department->log('update_department');
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentAuthoritiesUpdated')); 
        return redirect()->route('system-management.departments-authorities.index');
    }
}
