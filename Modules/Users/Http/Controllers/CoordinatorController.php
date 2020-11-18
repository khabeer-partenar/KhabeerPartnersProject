<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Http\Requests\SaveCoordinatorRequest;
use Modules\Users\Http\Requests\UpdateCoordinatorRequest;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Users\Notifications\NewUserAdded;
use Illuminate\Support\Facades\Notification;

class CoordinatorController extends UserBaseController
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
        $coordinatorsData = Coordinator::with('mainDepartment', 'parentDepartment', 'directDepartment')->search($request)->paginate(10);
        $mainDepartments = Department::getDepartments();
        return view('users::coordinators.index', compact('mainDepartments', 'coordinatorsData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments = Department::getDepartments();
        $coordinatorJobs = Group::whereIn('key', [Coordinator::MAIN_CO_JOB, Coordinator::NORMAL_CO_JOB])->get(['id', 'name', 'key']);
        return view("users::coordinators.create", compact('mainDepartments', 'coordinatorJobs'));
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
        Notification::send($coordinator, new NewUserAdded($coordinator));
        self::sessionSuccess('users::coordinators.created');
        return redirect()->route('coordinators.index');
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
        return view("users::coordinators.edit", compact('coordinator',  'mainDepartments', 'coordinatorJobs'));
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
