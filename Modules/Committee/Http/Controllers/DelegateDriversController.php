<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDriver;
use Modules\Committee\Entities\Committee;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Modules\Committee\Http\Requests\DelegateDriverRequest;

class DelegateDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $driversData = MeetingDriver::where('name', 'LIKE', '%'. $request->input('search') .'%')->select('id', 'name as text')->get();
        return response()->json(['results' => $driversData], 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DelegateDriverRequest $request)
    {
        $driver = MeetingDriver::createFromRequest($request);
        $driver->load('religion', 'nationality');
        return response()->json([
            'driver' => $driver,
        ], 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Request $request, Committee $committee, Meeting $meeting)
    {
        $driver = MeetingDriver::with('religion', 'nationality')->where('id', $request->driver_id)->first();

        return response()->json(['driver' => $driver ], 200);
    }
}
