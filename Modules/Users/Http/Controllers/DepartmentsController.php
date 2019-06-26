<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\SystemManagement\Entities\Department;

class DepartmentsController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function loadDepartmentsByParentId(Request $request)
    {
        $parentId = $request->get('parentId');
        if (!$parentId) {
            abort(404);
        }
        $departments = Department::where('parent_id', $parentId)->get(['id', 'name'])->prepend(Department::getEmptyObjectForSelectAjax());
        return response()->json($departments);
    }
}
