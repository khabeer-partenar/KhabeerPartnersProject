<?php

namespace Modules\Committee\Http\Controllers;

use Modules\Committee\Entities\Meeting;
use Illuminate\Routing\Controller;
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
    public function store(Request $request)
    {
        $driver = MeetingDriver::createFromRequest($request);
        $driver->load('religion');

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
        $driver = MeetingDriver::with('religion')->where('id', $request->driver_id)->first();

        return response()->json(['driver' => $driver ], 200);
    }
}