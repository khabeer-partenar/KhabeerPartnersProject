<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDocument;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\Committee\Events\NominationDoneEvent;
use Modules\Committee\Http\Requests\SaveCommitteeRequest;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\DataTables;

class CommitteeController extends UserBaseController
{
    use SessionFlash, Log;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $committeesQuery = Committee::with('advisor', 'president')->latest()->search($request);
            $dataTable = Datatables::of($committeesQuery)
                ->addColumn('id_with_date', function ($committee) {
                    $data = [__('committee::committees.committee number') . $committee->treatment_number, $committee->created_at->format('d-m-Y')];
                    return view('committee::committees.br_separated_data', compact('data'));
                })
                ->addColumn('committee_uuid_with_subject', function ($committee) {
                    $data = [$committee->uuid, $committee->subject];
                    return view('committee::committees.br_separated_data', compact('data'));
                })
                ->addColumn('advisor_with_members_count', function ($committee) {
                    $data = [
                        __('committee::committees.advisor_only') . ' ' . $committee->advisor->name,
                        __('committee::committees.member') . ' ' . $committee->members_count
                    ];
                    return view('committee::committees.br_separated_data', compact('data'));
                })
                ->addColumn('president', function ($committee) {
                    return $committee->president ? $committee->president->name : '-';
                })
                ->addColumn('status', function ($committee) {
                    return __('committee::committees.' . $committee->status);
                })
                ->addColumn('action', function ($committee) {
                    return view('committee::committees.actions', compact('committee'));
                });

            if (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
                $dataTable->addColumn('advisor_status', function ($committee) {
                    return $committee->advisor_id == auth()->id() ?
                        __('committee::committees.committee advisor')
                        : __('committee::committees.committee participant');
                });
            }

            return $dataTable->rawColumns([
                'action', 'id_with_date', 'committee_uuid_with_subject', 'advisor_with_members_count', 'advisor_status'
            ])->make(true);
        }
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $status = Committee::STATUS;
        return view('committee::committees.index', compact('advisors', 'status'));
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
        $recommendedDepartments = Department::where('type', Department::parentDepartment)->recommended()->pluck('name', 'id');
        $sourceOfStudiesDepartments = Department::where('type', Department::parentDepartment)->sourceOfStudy()->pluck('name', 'id');
        $studyCommission = Employee::studyChairman()->pluck('name', 'id');
        $presidents = Group::presidentsUsers()->pluck('name', 'id');
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $allAdvisors = Group::advisorUsersFilter()->pluck('users.name', 'users.id');
        $departmentsWithRef = Department::where('type', Department::parentDepartment)->with('referenceDepartment')->get();
        $documents = CommitteeDocument::where('user_id', auth()->id())->whereNull('committee_id')->get();
        return view('committee::committees.create', compact(
            'treatmentTypes', 'recommendedDepartments', 'departments', 'sourceOfStudiesDepartments',
            'treatmentImportance', 'treatmentUrgency', 'presidents', 'studyCommission', 'departmentsWithRef',
            'documents', 'advisors', 'allAdvisors'
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
        return redirect()->route('committees.index');
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

    /**
     * @param Committee $committee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Committee $committee)
    {
//        dd($committee->creator);
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
        $recommendedDepartments = Department::where('type', Department::parentDepartment)->recommended()->pluck('name', 'id');
        $sourceOfStudiesDepartments = Department::where('type', Department::parentDepartment)->sourceOfStudy()->pluck('name', 'id');
        $studyCommission = Employee::studyChairman()->pluck('name', 'id');
        $presidents = Group::presidentsUsers()->pluck('name', 'id');
        $advisors = Group::advisorUsersFilter()->filterByJob()->pluck('users.name', 'users.id');
        $allAdvisors = Group::advisorUsersFilter()->pluck('users.name', 'users.id');
        $departmentsWithRef = Department::where('type', Department::parentDepartment)->with('referenceDepartment')->get();
        return view('committee::committees.edit', compact(
            'committee', 'treatmentTypes', 'departments', 'recommendedDepartments', 'sourceOfStudiesDepartments', 'treatmentImportance', 'treatmentUrgency',
            'presidents', 'studyCommission', 'departmentsWithRef', 'advisors', 'allAdvisors'
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
     * @param Request $request
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function destroy(Request $request, Committee $committee)
    {
        $request->validate(['reason' => 'required|string|max:300']);
        $committee->update(['reason_of_deletion' => $request->reason]);
        $committee->log('delete_committee');
        $committee->delete();
        return response()->json(['msg' => __('committee::committees.deleted')]);
    }

    public function sendNomination(Committee $committee)
    {
        $committee->log('send nomination');
        if ($committee->status==Committee::NOMINATIONS_COMPLETED) {
            return response()->json(['status' => $committee->status, 'msg' => __('committee::committees.nomination_send_successfully')]);
        }
        else
        {
            event(new NominationDoneEvent($committee));
            return response()->json(['status' => $committee->status, 'msg' => __('committee::committees.nomination_not_compeleted')]);

        }

    }
}
