<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Delegate;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Http\Requests\SaveCoordinatorRequest;
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
     * CoordinatorController constructor.
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
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $delegatesQuery = Delegate::with('mainDepartment', 'parentDepartment', 'directDepartment')
                ->search($request);

            return Datatables::of($delegatesQuery)
                ->addColumn('department_info', function ($delegate) {
                    $data = [
                        $delegate->mainDepartment->name,
                        $delegate->parentDepartment->name,
                        $delegate->directDepartment ? $delegate->directDepartment->name:null
                    ];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('national_id', function($delegate) {
                    $data = [$delegate->national_id];
                    return view('users::delegates.commas_separated_data', ['data' => $data, 'break' => 1 ]);
                })
                ->addColumn('phone_number', function($delegate) {
                    $data = [$delegate->phone_number];
                    return view('users::delegates.commas_separated_data', ['data' => $data, 'break' => 1 ]);
                })
                ->addColumn('email', function($delegate) {
                    $data = [$delegate->email];
                    return view('users::delegates.commas_separated_data', ['data' => $data, 'break' => 1 ]);
                })
                ->addColumn('action', function ($delegate) {
                    return view('users::delegates.actions', compact('delegate'));
                })->rawColumns(['action', 'contact_options'])->make(true);
        }
        $mainDepartments = Department::getDepartments();
        return view('users::delegates.index', compact('mainDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments = Department::getDepartments();
        $coordinatorJobs = Group::whereIn('key', [Coordinator::MAIN_CO_JOB, Coordinator::NORMAL_CO_JOB])->get(['id', 'name', 'key']);
        return view("users::coordinators.$this->userType.create", compact('mainDepartments', 'coordinatorJobs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaveCoordinatorRequest $request
     * @return Response
     */
    public function store(SaveCoordinatorRequest $request)
    {
        $coordinator = Coordinator::createFromRequest($request);
        $coordinator->log('create_coordinator');
        self::sessionSuccess('users::coordinators.created');
        return back();
    }

    /**
     * Show the specified resource.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function show(Coordinator $coordinator)
    {
        return view('users::coordinators.show', compact('coordinator'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function edit(Coordinator $coordinator)
    {
        $mainDepartments = Department::getDepartments();
        $coordinatorJobs = Group::whereIn('key', [Coordinator::MAIN_CO_JOB, Coordinator::NORMAL_CO_JOB])->get(['id', 'name', 'key']);
        return view("users::coordinators.$this->userType.edit", compact('coordinator',  'mainDepartments', 'coordinatorJobs'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCoordinatorRequest $request
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function update(UpdateCoordinatorRequest $request, Coordinator $coordinator)
    {
        $coordinator->updateFromRequest($request);
        $coordinator->log('update_coordinator');
        self::sessionSuccess('users::coordinators.updated');
        return redirect()->route('coordinators.index');
    }

    /**
     * Store Coordinator by Coordinator
     *
     * @param SaveCoordinatorRequestByCo $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeByCoordinator(SaveCoordinatorRequestByCo $request)
    {
        $coordinator = Coordinator::createFromRequest($request);
        $coordinator->log('create_coordinator_by_main_coordinator');
        self::sessionSuccess('users::coordinators.created');
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCoordinatorRequestByCo $request
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function updateByCoordinator(UpdateCoordinatorRequestByCo $request, Coordinator $coordinator)
    {
        $coordinator->updateFromRequest($request);
        $coordinator->log('update_coordinator_by_main_coordinator');
        self::sessionSuccess('users::coordinators.updated');
        return redirect()->route('coordinators.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function destroy(Coordinator $coordinator)
    {
        $coordinator->log('delete_coordinator');
        $coordinator->delete();
        return response()->json(['msg' => __('users::coordinators.deleted')]);
    }
}
