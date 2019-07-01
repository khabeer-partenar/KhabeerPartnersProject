<?php

namespace Modules\SystemManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\SystemManagement\Entities\Department;

use Modules\SystemManagement\Http\Requests\SaveDepartmentTypeCreateRequest;

class DepartmentController extends UserBaseController
{

    /**
     * Search in departments
     * @return Response
     */
    public function search(Request $request, $type)
    {
        $departmentsData = Department::ajaxSearch($type, $request->input('search'));
        return response()->json(['results' => $departmentsData], 200);
    }

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
               ->addColumn('action', function ($departmentsData) {
                    return view('systemmanagement::departmentsTypes.actions', compact('departmentsData'));
               })
               ->toJson();
        }

        return view('systemmanagement::departmentsTypes.index');
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
    public function departmentsTypesStore(SaveDepartmentTypeCreateRequest $request)
    {
        $data = ['name' => $request->dept_name, 'type' => 1];
        Department::createNewDepartment($data);
        session()->flash('alert-success', __('systemmanagement::systemmanagement.departmentTypeCreated')); 
        return redirect()->route('system-management.departments-types.index');
    }
}
