<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\Committee\Http\Requests\SaveCommitteeRequest;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;
use Modules\Users\Traits\SessionFlash;

class CommitteeController extends Controller
{
    use SessionFlash, Log;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('committee::committees.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $treatmentTypes = TreatmentType::pluck('name', 'id');
        $treatmentUrgency = TreatmentUrgency::pluck('name', 'id');
        $treatmentImportance = TreatmentImportance::pluck('name', 'id');
        $departments = Department::where('type', Department::parentDepartment)->pluck('name', 'id');
        $studyCommission = Employee::studyChairman()->pluck('name', 'id');
        $presidents = Group::presidentsUsers()->pluck('name', 'id');
        return view('committee::committees.create', compact(
            'treatmentTypes', 'departments', 'treatmentImportance', 'treatmentUrgency',
            'presidents', 'studyCommission'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaveCommitteeRequest $request
     * @return Response
     */
    public function store(SaveCommitteeRequest $request)
    {
        $committee = Committee::createFromRequest($request);
        $committee->log('create_committee');
        self::sessionSuccess('committees::committees.created');
        return back();
    }

    /**
     * Show the specified resource.
     * @param Committee $committee
     * @internal param int $id
     * @return Response
     */
    public function show(Committee $committee)
    {

        return view('committee::committees.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Committee $committee
     * @return Response
     */
    public function edit(Committee $committee)
    {
        return view('committee::committees.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function update(Request $request, Committee $committee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function destroy(Committee $committee)
    {
        //
    }
}