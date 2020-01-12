<?php

namespace Modules\SystemManagement\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\SystemManagement\Http\Requests\SaveMeetingRoomRequest;
use Modules\SystemManagement\Http\Requests\UpdateMeetingRoomRequest;
use Modules\Core\Entities\City;
use Modules\SystemManagement\Entities\MeetingRoom;

class MeetingsRoomsController extends UserBaseController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $meetingsRoomsData = MeetingRoom::with('city')->search($request)->get();

        if ($request->wantsJson() || $request->ajax()) {

            $meetingsRoomsData = MeetingRoom::with('city')->search($request);


            return Datatables::of($meetingsRoomsData)
                ->addColumn('city_name', function ($meetingRoom) {
                    return @$meetingRoom->city->name;
                })
                ->addColumn('action', function ($meetingRoom) {
                    return view('systemmanagement::meetingsRooms.actions', compact('meetingRoom'));
                })
                ->toJson();
        }

        $cities  = City::pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        $statues = MeetingRoom::STATUS_TEXT;

        return view('systemmanagement::meetingsRooms.index', compact('cities', 'statues'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        $statues = MeetingRoom::STATUS_TEXT;
        return view('systemmanagement::meetingsRooms.create', compact('cities', 'statues'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaveCommitteeRequest $request
     * @return Response
     */
    public function store(SaveMeetingRoomRequest $request)
    {
        $meetingRoom = MeetingRoom::createFormRequest($request);
        $meetingRoom->log('create_meeting_room');
        session()->flash('alert-success', __('systemmanagement::meetingsRooms.created'));
        return redirect()->route('system-management.meetings-rooms.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, MeetingRoom $meetingRoom)
    {
        $cities = City::pluck('name', 'id')->prepend(__('messages.choose_option'), '');
        $statues = MeetingRoom::STATUS_TEXT;
        return view('systemmanagement::meetingsRooms.edit', compact('meetingRoom', 'cities', 'statues'));
    }

    /**
     * Show the form for creating a new resource.
     * @param UpdateMeetingRoomRequest $request
     * @param MeetingRoom $meetingRoom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMeetingRoomRequest $request, MeetingRoom $meetingRoom)
    {
        $meetingRoom->updateFormRequest($request);
        $meetingRoom->log('update_meeting_room');
        session()->flash('alert-success', __('systemmanagement::meetingsRooms.updated'));
        return redirect()->route('system-management.meetings-rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, MeetingRoom $meetingRoom)
    {
        $meetingRoom->log('delete_meeting_room');
        $meetingRoom->delete();
        return response()->json('', 200);
    }

    /**
     * Get Room with Details
     * @param Request $request
     * @return MeetingRoom $room
     * @internal param MeetingRoom $room
     */
    public function roomWithMeetings(Request $request)
    {
        $room = MeetingRoom::with('city')->findOrFail($request->room_id);
        $room->meetings = $room->meetings()->where('from', '>=', Carbon::today())->orderBy('from', 'asc')->get();
        return response()->json($room);
    }
}
