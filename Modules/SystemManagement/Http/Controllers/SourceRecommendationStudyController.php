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

class SourceRecommendationStudyController extends UserBaseController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $departmentsData = Department::getDepartmentsData(Department::parentDepartment)->with('parent')->search($request)->paginate(10);
        $mainDepartmentsData   = Department::getDepartmentsData(Department::mainDepartment)->pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        $parentDepartmentsData = Department::getParentDepartments($request->parent_department_id);
        return view('systemmanagement::sourceRecommendationStudy.index', compact('departmentsData', 'mainDepartmentsData', 'parentDepartmentsData'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Department $department
     * @return Response
     * @internal param int $id
     */
    public function edit(Request $request, Department $department)
    {
        return view('systemmanagement::sourceRecommendationStudy.edit', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        $department->update([
            'shown_in_committee_recommended' => $request->shown_in_committee_recommended == 1 ? true : false,
            'shown_in_committee_source_of_study' => $request->shown_in_committee_source_of_study == 1 ? true : false,
        ]);
        $department->log('update_department');
        session()->flash('alert-success', __('systemmanagement::sourceRecommendationStudy.departmentUpdated'));
        return redirect()->route('system-management.source-recommendation-study.index');
    }


}
