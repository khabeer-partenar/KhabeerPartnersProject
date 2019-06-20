<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Department;
use Modules\Users\Http\Requests\SaveCoordinatorRequest;
use Modules\Users\Traits\SessionFlash;
use Yajra\DataTables\Facades\DataTables;

class CoordinatorController extends Controller
{
    use SessionFlash;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $userQuery = Coordinator::select('id', 'name', 'national_id', 'email', 'phone_number');

            return Datatables::of($userQuery)
                ->addColumn('action', function ($coordinator) {
                    return view('users::coordinators.actions', compact('coordinator'));
                })->make(true);
        }
        return view('users::coordinators.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments = Department::getDepartments();
        $coordinator = Group::where('key', 'coordinator')->pluck('name', 'id');
        return view('users::coordinators.create', compact('mainDepartments', 'coordinator'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaveCoordinatorRequest $request
     * @return Response
     */
    public function store(SaveCoordinatorRequest $request)
    {
        Coordinator::createFromRequest($request);
        self::sessionSuccess('coordinators.created');
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

        return view('users::coordinators.edit', compact($coordinator));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function update(SaveCoordinatorRequest $request, Coordinator $coordinator)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param Coordinator $coordinator
     * @return Response
     * @internal param int $id
     */
    public function destroy(Coordinator $coordinator)
    {
        //
    }
}
