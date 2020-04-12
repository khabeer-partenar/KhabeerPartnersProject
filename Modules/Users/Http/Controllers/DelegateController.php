<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDelegate;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Http\Requests\SaveDelegateRequest;
use Modules\Users\Http\Requests\AddDelegatesToCommittee;

use Modules\Users\Http\Requests\SaveCoordinatorRequestByCo;
use Modules\Users\Http\Requests\UpdateCoordinatorRequest;
use Modules\Users\Http\Requests\UpdateCoordinatorRequestByCo;
use Modules\Users\Http\Requests\UpdateDelegateRequest;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\Facades\DataTables;
use Crypt;

class DelegateController extends UserBaseController
{
    use SessionFlash;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     * @internal param Request $request
     */
    public function index(Request $request)
    {
        $delegatesData = Delegate::UserDepartment()->with('mainDepartment', 'parentDepartment', 'directDepartment')->search($request)->paginate(10);
        $mainDepartments = Department::getDepartments();
        return view('users::delegates.index', compact('mainDepartments', 'delegatesData'));
    }

    public function show(Delegate $delegate)
    {
        return view('users::delegates.show', compact('delegate'));
    }

    public function getDepartmentDelegatesNotInCommittee($department_id, $committee_id)
    {
        if (CommitteeDelegate::checkIfMainCoordinatorNominateDelegates($committee_id)) {
            return response()->json(['code' => '0', 'msg' => __('users::delegates.delegate_can_not_delegate')]);
        } else {
            $delegates = Delegate::getDepartmentDelegatesNotInCommittee($department_id, $committee_id);
            return $delegates;
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);
        return view("users::delegates.create", compact('mainDepartments', 'delegateJobs'));
    }

    public function addDelegatesToCommittee(AddDelegatesToCommittee $request, Delegate $delegate)
    {
        if ($request->has('delegates_ids')) {
            $delegate->addDelegatesToCommittee($request);
            return back();

        }
    }

    public function checkIfMainCoordinatorNominateDelegates($committee_id)
    {
        $status = CommitteeDelegate::checkIfMainCoordinatorNominateDelegates($committee_id);
        $message = '';
        if ($status == true) {
            $message = __('users::delegates.delegate_can_not_delegate');
        }
        return response()->json(['status' => $status
            , 'msg' => $message]);

    }

    /**
     * Store a newly created resource in storage.
     * @param SaveCoordinatorRequest $request
     * @return Response
     */
    public function store(SaveDelegateRequest $request, Delegate $delegate2)
    {
        $delegate = Delegate::createFromRequest($request);
        $delegate->log('create_delegate');
        if (isset($request->committee_id)) {
            $delegate2->addDelegateToCommittee($request, $delegate->id);
        } else {
            self::sessionSuccess('users::delegates.created');
            return redirect()->route('delegates.index');
        }

    }

    public function edit(Delegate $delegate)
    {
        $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);
        return view("users::delegates.edit", compact('mainDepartments', 'delegateJobs', 'delegate'));
    }

    public function update(UpdateDelegateRequest $request, Delegate $delegate)
    {
        $delegate->updateFromRequest($request);
        $delegate->log('update_delegate');
        self::sessionSuccess('users::delegates.updated');
        return redirect()->route('delegates.index');
    }

    public function destroy(Delegate $delegate)
    {
        if ($delegate->checkIfDelegateInMeetings())
        {
            return response()->json(['status' =>true, 'msg'=> __('users::delegates.delegate_in_meetings_can_not_remove')]);
        }
        $delegate->log('delete_delegate');
        $delegate->delete();
        return response()->json(['msg' => __('users::delegates.deleted')]);
    }

    public function removeFromCommitte($delegate_id, $committee_id, $department_id, $reason)
    {
        $delegate = Delegate::find($delegate_id);
        if (CommitteeDelegate::checkIfMainCoordinatorNominateDelegates($committee_id)) {
            return response()->json(['code' => '0', 'msg' => __('users::delegates.delegate_can_not_delete')]);

        }
        elseif ($delegate->checkIfDelegateInMeetings())
        {
            return response()->json(['code' => '0', 'msg' => __('users::delegates.delegate_in_meetings_can_not_remove')]);
        }
        else {
            $delegate = Delegate::find($delegate_id);
            $delegate->log('remove_delegate_from_committee');
            $delegate->removeDelegateFromCommittee($delegate, $committee_id, $department_id, $reason,true);
            return response()->json(['code' => '1', 'msg' => __('users::delegates.deleted')]);
        }
    }
}
