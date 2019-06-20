<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Core\Entities\Department;

class DepartmentsController extends UserBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function loadDepartmentsTypesByParentId(Request $request, $parentId)
    {
        $departments = Department::select('id', 'parent_id', 'name')->where('parent_id', $parentId)->get();
        return $departments;
    }
    
}
