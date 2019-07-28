<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Delegate;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Http\Requests\SaveDelegateRequest;
use Modules\Users\Http\Requests\SaveCoordinatorRequestByCo;
use Modules\Users\Http\Requests\UpdateCoordinatorRequest;
use Modules\Users\Http\Requests\UpdateCoordinatorRequestByCo;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\Facades\DataTables;

class DelegateController extends UserBaseController
{
    use SessionFlash;

    protected $userType = '';

    /**
     * DelegateController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type == Delegate::TYPE){
                $this->userType = Delegate::TYPE;
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     * @internal param Request $request
     */
    public function index(Request $request,Committee $committee)
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

      /*  $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);*/
        return view("users::delegates.$this->userType..create", compact('mainDepartments', 'delegateJobs'));
    }
    public function removeDelegateFromCommittee(Delegate $delegate)
    {
        $delegate->log('remove_delegate_from_committee');
        $delegate->removeDelegateFromCommittee($delegate);
        return response()->json(['msg' => __('users::delegates.deleted')]);
    }
    public function addDelegatesToCommittee(Request $request,Delegate $delegate)
    {
        if ($request->has('delegates_ids')) {

            $delegate->addDelegatesToCommittee($request);
            //dd($request->all());
            return back();

        }
    }
    /**
     * Store a newly created resource in storage.
     * @param SaveCoordinatorRequest $request
     * @return Response
     */
    public function store(SaveDelegateRequest $request,Delegate $delegate2)
    {
            $delegate = Delegate::createFromRequest($request);
            $delegate->log('create_delegate');
            $delegate2->addDelegateToCommittee($request,$delegate->id);
            self::sessionSuccess('users::delegates.created');
            return back();
    }


    /**
     * Remove the specified resource from storage.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */

    public function destroy(Delegate $delegate)
    {
        //Delegate::find($delegate->id);
        /*$delegate->log('delete_coordinator');
        $delegate->delete();*/

        $delegate->log('remove_delegate_from_committee');
        $delegate->removeDelegateFromCommittee($delegate);
        return response()->json(['msg' => __('users::delegates.deleted')]);
    }
}
