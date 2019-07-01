<?php

namespace Modules\SystemManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SystemManagement\Entities\Department;

class SystemManagementController extends Controller
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
    public function departmentsTypes()
    {
        return view('systemmanagement::departmentsTypes.index');
    }

  
}
