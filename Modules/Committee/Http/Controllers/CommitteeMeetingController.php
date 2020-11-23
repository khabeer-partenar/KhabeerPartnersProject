<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Entities\MeetingType;
use Modules\Committee\Http\Requests\SaveMeetingRequest;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Users\Entities\User;
use Modules\Users\Traits\SessionFlash;
use Modules\Committee\Notifications\MeetingCreated;
use Modules\Committee\Notifications\MeetingCancelled;
use Modules\Committee\Notifications\MeetingParticpatingUpdated;

class CommitteeMeetingController extends UserBaseController
{
    use SessionFlash;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Committee $committee
     * @return Response
     */
    public function index(Committee $committee)
    {
        $meetings = $committee->meetings()
            ->filterByUser($committee)
            ->orderBy('from', 'asc')
            ->with([
                'type',
                'attendingDelegates',
                'absentDelegates',
                'attendingAdvisors',
                'room'
            ])
            ->withTrashed()
            ->paginate(10);

        return view('committee::meetings.index', compact('committee', 'meetings'));
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
        $documents = MeetingDocument::where('user_id', auth()->id())
            ->where('committee_id', $committee->id)
            ->whereNull('meeting_id')->get();

        return view('committee::meetings.create', compact(
            'committee', 'types', 'rooms', 'documents'
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
        $toBeNotifiedUsers = $meeting->participantAdvisors->merge($meeting->committee->participantDepartmentsUsersUnique());
        if($toBeNotifiedUsers->count())
        self::sessionSuccess('committee::meetings.created successfully');
        return redirect()->route('committee.meetings', compact('committee'));
    }

    /**
     * Show the specified resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function show(Committee $committee, Meeting $meeting)
    {
        $meeting->load([
            'delegates' => function($query) use ($meeting){
                $query->with([
                    'multimedia' => function($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'documents' => function($query) use ($meeting) {
                        $query->where('meeting_id', $meeting->id);
                    },
                    'department'
                ]);
            }
        ]);

        return view('committee::meetings.show', compact('committee', 'meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function edit(Committee $committee, Meeting $meeting)
    {
        $types = MeetingType::all()->pluck('name', 'id');
        $rooms = MeetingRoom::active()->with('city')->get();
        $meetingDelegates = $meeting->delegates->pluck('id')->toArray();
        $meetingAdvisors = $meeting->participantAdvisors->pluck('id')->toArray();
        $documents = MeetingDocument::where('user_id', auth()->id())
            ->where('committee_id', $committee->id)
            ->where('meeting_id', $meeting->id)->get();

        return view('committee::meetings.edit', compact(
            'committee', 'meeting', 'meetingDelegates', 'meetingAdvisors', 'types', 'rooms', 'documents'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request|SaveMeetingRequest $request
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function update(SaveMeetingRequest $request, Committee $committee, Meeting $meeting)
    {
        $meeting->updateFromRequest($request, $committee);
        $meeting->log('edit_meeting_for_committee : ' . $committee->id);
        self::sessionSuccess('committee::meetings.updated successfully');
        return redirect()->route('committee.meetings', compact('committee'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function destroy(Committee $committee, Meeting $meeting)
    {
        $meeting->log('meeting_cancel_for_committee : ' . $committee->id);
        $toBeNotifiedUsers = $meeting->participantAdvisors->merge($meeting->delegates);
        if($toBeNotifiedUsers->count())
            Notification::send($toBeNotifiedUsers, new MeetingCancelled($meeting->committee,$meeting));
        $meeting->delete();
        self::sessionSuccess('committee::meetings.meeting_cancelled');
        return response()->json([], 200);
    }
}
