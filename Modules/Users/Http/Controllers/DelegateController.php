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
    public function index(Request $request)
    {
     /*  $delegatesQuery = Delegate::with(['department' => function($query) {
            $query->with('referenceDepartment');
        }])->get();
        DD($delegatesQuery->first());*/
        if ($request->wantsJson() || $request->ajax()) {
            $delegatesQuery = Delegate::with(['department' => function($query) {
                    $query->with('referenceDepartment');
                }])->get();

            return Datatables::of($delegatesQuery)
                ->addColumn('department_info', function ($delegate) {
                    $data = [
                        $delegate->department->name,
                        $delegate->referenceDepartment ? '/' . $delegate->referenceDepartment->name:null
                    ];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('name', function($delegate) {
                    $data = [$delegate->name];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('job_title', function($delegate) {
                    $data = [$delegate->job_title];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('national_id', function($delegate) {
                    $data = [$delegate->national_id];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('phone_number', function($delegate) {
                    $data = [$delegate->phone_number];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('email', function($delegate) {
                    $data = [$delegate->email];
                    return view('users::delegates.commas_separated_data', ['data' => $data]);
                })
                ->addColumn('action', function ($delegate) {
                    return view('users::delegates.actions', compact('delegate'));
                })->rawColumns(['action'])->make(true);
        }

        //$mainDepartments = Department::getDepartments();
        //return view('users::delegates.index', compact('mainDepartments'));
        return view('users::delegates.index');
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

    public function addCordinatorToCommitte(Request $request)
    {
        dd($request->all());
    }
    /**
     * Store a newly created resource in storage.
     * @param SaveCoordinatorRequest $request
     * @return Response
     */
    public function store(SaveCoordinatorRequest $request)
    {
        dd($request->all());
        $delegate = Delegate::createFromRequest($request);
        $delegate->log('create_delegate');
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
        $delegate->log('delete_coordinator');
        $delegate->delete();
        return response()->json(['msg' => __('users::delegates.deleted')]);
    }
}
