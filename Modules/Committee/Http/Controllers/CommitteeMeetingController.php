<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Entities\MeetingType;
use Modules\Committee\Http\Requests\SaveMeetingRequest;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Users\Traits\SessionFlash;

class CommitteeMeetingController extends Controller
{
    use SessionFlash;
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @return Response
     */
    public function index(Committee $committee)
    {

        return view('committee::meetings.index', compact('committee'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Committee $committee
     * @return Response
     */
    public function create(Committee $committee)
    {
        $types = MeetingType::all()->pluck('name', 'id');
        $rooms = MeetingRoom::active()->with('city')->get();
        $participantAdvisors = $committee->participantAdvisors;
        $delegates = $committee->delegates;
        $documents = MeetingDocument::where('user_id', auth()->id())
            ->where('committee_id', $committee->id)
            ->whereNull('meeting_id')->get();
        return view('committee::meetings.create', compact(
            'committee', 'types', 'rooms', 'documents', 'participantAdvisors', 'delegates'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaveMeetingRequest $request
     * @param Committee $committee
     * @return Response
     */
    public function store(SaveMeetingRequest $request, Committee $committee)
    {
        $meeting = Meeting::createFromRequest($request, $committee);
        $meeting->log('create_new_meeting_for_committee : ' . $committee->id);
        self::sessionSuccess('committee::meetings.created successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('committee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('committee::edit');
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
