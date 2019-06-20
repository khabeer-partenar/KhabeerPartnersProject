<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Department;
use Modules\Users\Http\Requests\SaveCoordinatorRequest;
use Yajra\DataTables\Facades\DataTables;

class CoordinatorController extends Controller
{
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
                ->addColumn('action', function ($user) {
                    return '
                    <a href="'. route('users.upgrate_to_super_admin', $user->id) .'" class="btn btn-xs btn-'. ($user->is_super_admin == 1 ? 'danger' : 'primary') .' confirm-message">
                        <i class="fa fa-key"></i> Admin
                    </a>

                    <a href="'. route('users.edit', $user->id) .'" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i> تعديل المتسخدم
                    </a>

                    <a href="'. route('users.destroy-confirmation', $user->id) .'" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> تعطيل المستخدم
                    </a>

                    ';
                })
                ->make(true);
        }
        return view('users::coordinators.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mainDepartments   = Department::getDepartments();
        $coordinator = Group::where('key', 'coordinator')->pluck('name', 'id');
        return view('users::coordinators.create', compact('mainDepartments', 'coordinator'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SaveCoordinatorRequest $request)
    {
        dd($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('coordinators::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('coordinators::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
