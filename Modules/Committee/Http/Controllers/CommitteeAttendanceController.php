<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\MeetingType;
use Modules\SystemManagement\Entities\Department;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CommitteeAttendanceController extends Controller
{
    /**
     * This Method Should be seen by Coordinator
     * Show the specified resource.
     * @param Request $request
     * @param Committee $committee
     * @return Response
     */
    public function show(Request $request, Committee $committee)
    {
        $departmentsIds = auth()->user()->coordinatorAuthorizedIds();
        $departments = Department::with('referenceDepartment')->whereIn('id', $departmentsIds)->get();
        $types = MeetingType::pluck('name', 'id');
        $committee->load(['meetings' => function($query) use ($departmentsIds, $request) {
            $query->with([
                'delegates' => function($query) use ($departmentsIds, $request) {
                    $query->whereIn('parent_department_id', $departmentsIds)->with('department');
                    if ($request->get('department_id')) {
                        $query->where('parent_department_id', $request->get('department_id'));
                    }
                    if (!is_null($request->get('attended')) && $request->get('attended') != -1) {
                        $query->wherePivot('attended', $request->get('attended'))->wherePivot('attended', '!=', NULL);
                    }
                },
                'type'
            ])->filterType($request->all())->orderBy('from', 'asc');
        }]);

        return view('committee::committees.coordinator.attendance', compact('committee', 'departments', 'types'));
    }


    public function print( Request $request, Committee $committee)
    {
        $departmentsIds = auth()->user()->coordinatorAuthorizedIds();
        $departments = Department::with('referenceDepartment')->whereIn('id', $departmentsIds)->get();
        $types = MeetingType::pluck('name', 'id');
        $committee->load(['meetings' => function($query) use ($departmentsIds, $request) {
            $query->with([
                'delegates' => function($query) use ($departmentsIds, $request) {
                    $query->whereIn('parent_department_id', $departmentsIds)->with('department');
                    if ($request->get('department_id')) {
                        $query->where('parent_department_id', $request->get('department_id'));
                    }
                    if (!is_null($request->get('attended')) && $request->get('attended') != -1) {
                        $query->wherePivot('attended', $request->get('attended'))->wherePivot('attended', '!=', NULL);
                    }
                },
                'type'
            ])->filterType($request->all())->orderBy('from', 'asc');
        }]);
        $pdf = PDF::loadView('committee::committees.coordinator.print',compact('committee', 'departments', 'types'));
        return $pdf->stream('document.pdf');
    }
}
