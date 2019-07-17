<?php

namespace Modules\Committee\Http\Controllers;

use App\Classes\Date\CarbonHijri;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDocument;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\Committee\Http\Requests\SaveCommitteeRequest;
use Modules\Core\Entities\Group;
use Modules\Core\Traits\Log;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Employee;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\DataTables;

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
        if ($request->wantsJson() || $request->ajax()) {
            $committeesQuery = Committee::with('advisor', 'president')->search($request);

            return Datatables::of($committeesQuery)
                ->addColumn('id_with_date', function ($committee) {
                    $data = [__('committee::committees.committee number') . $committee->id, $committee->created_at->format('d-m-Y')];
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
                    return $committee->president ? $committee->president->name:'-';
                })
                ->addColumn('status', function ($committee) {
                    return __('committee::committees.'.$committee->status);
                })
                ->addColumn('action', function ($committee) {
                    return view('committee::committees.actions', compact('committee'));
                })
                ->rawColumns(['action', 'id_with_date', 'committee_uuid_with_subject', 'advisor_with_members_count'])
                ->make(true);
        }

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
        $departmentsWithRef = Department::where('type', Department::parentDepartment)->with('referenceDepartment')->get();
        $documents = CommitteeDocument::where('user_id', auth()->id())->whereNull('committee_id')->get();
        return view('committee::committees.create', compact(
            'treatmentTypes', 'departments', 'treatmentImportance', 'treatmentUrgency',
            'presidents', 'studyCommission', 'departmentsWithRef', 'documents'
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
