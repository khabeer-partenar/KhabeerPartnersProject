<?php

namespace Modules\Committee\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDelegate;
use Modules\Committee\Entities\CommitteeDocument;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\Committee\Events\NominationDoneEvent;
use Modules\Committee\Http\Requests\SaveCommitteeRequest;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
class CommitteeController extends Controller
{
    use SessionFlash, Log;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $committeesQuery = Committee::with('advisor', 'president')->latest()->search($request)->paginate(10);
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $status = Committee::STATUS;
        return view('committee::committees.index', compact('committeesQuery','advisors', 'status'));
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
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $departmentsWithRef = Department::where('type', Department::parentDepartment)->with('referenceDepartment')->get();
        $documents = CommitteeDocument::where('user_id', auth()->id())->whereNull('committee_id')->get();
        return view('committee::committees.create', compact(
            'treatmentTypes', 'departments', 'treatmentImportance', 'treatmentUrgency',
            'presidents', 'studyCommission', 'departmentsWithRef', 'documents', 'advisors'
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
        self::sessionSuccess('committee::committees.created');
        return back();
    }

    /**
     * Show the specified resource.
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function getDelegatesWithDetails($committee_id)
    {
        $commitee_id = $committee_id;
        $committee = Committee::find($commitee_id);
        return $committee->getDelegatesWithDetails();
    }

    public function getNominationDepartmentsWithRef(Committee $committee)
    {
        return $committee->getNominationDepartmentsWithRef();
    }

    public function show(Committee $committee)
    {
        $delegates = $committee->getDelegatesWithDetails();
        $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);
        return view('committee::committees.show', compact('committee', 'delegates', 'mainDepartments', 'delegateJobs'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Committee $committee
     * @return Response
     */
    public function edit(Committee $committee)
    {
        $treatmentTypes = TreatmentType::pluck('name', 'id');
        $treatmentUrgency = TreatmentUrgency::pluck('name', 'id');
        $treatmentImportance = TreatmentImportance::pluck('name', 'id');
        $departments = Department::where('type', Department::parentDepartment)->pluck('name', 'id');
        $studyCommission = Employee::studyChairman()->pluck('name', 'id');
        $presidents = Group::presidentsUsers()->pluck('name', 'id');
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $departmentsWithRef = Department::where('type', Department::parentDepartment)->with('referenceDepartment')->get();
        return view('committee::committees.edit', compact(
            'committee', 'treatmentTypes', 'departments', 'treatmentImportance', 'treatmentUrgency',
            'presidents', 'studyCommission', 'departmentsWithRef', 'advisors'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function update(SaveCommitteeRequest $request, Committee $committee)
    {
        $committee = $committee->updateFromRequest($request);
        $committee->log('update_committee');
        self::sessionSuccess('committee::committees.updated');
        return redirect()->route('committees.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function destroy(Committee $committee)
    {
        $committee->log('delete_committee');
        $committee->delete();
        return response()->json(['msg' => __('committee::committees.deleted')]);
    }

    public function sendNomination(Committee $committee)
    {
        $committee->log('send nomination');
        event(new NominationDoneEvent($committee));
        return 'done';
    }
}
