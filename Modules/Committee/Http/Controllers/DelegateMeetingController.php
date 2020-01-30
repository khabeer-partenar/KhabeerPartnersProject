<?php

namespace Modules\Committee\Http\Controllers;

use Modules\Committee\Entities\Meeting;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\MeetingDriver;
use Modules\Committee\Entities\Nationality;
use Modules\Committee\Entities\Religion;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\MeetingMultimedia;
use Modules\Committee\Http\Requests\UpdateDelegateMeetingRequest;
use Modules\Users\Traits\SessionFlash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DelegateMeetingController extends Controller
{
    use SessionFlash;

    /**
     * Display the specified resource.
     *
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function show(Committee $committee, Meeting $meeting, MeetingDriver $driver, Request $request, Religion $religion)
    {
        $nationalities = Nationality::Nationalities;
        $religiones = $religion->all();
        $driverOptions   = [0 => __('messages.choose_option')];
        $drivers      = MeetingDriver::select('id', 'name')->searchDriver($request)->paginate(10);
        $delegate = auth()->user()->delegate;
        $documentsByDelegate = $delegate->documents()->where('meeting_id', $meeting->id)->get();
        $meetingDelegate = $meeting->delegates()->where('delegate_id', auth()->id())->first();

        return view('committee::meetings.delegates.show', compact( 'nationalities','meeting', 'documentsByDelegate', 'committee', 'meetingDelegate', 'driver', 'drivers', 'driverOptions', 'religiones'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Meeting $meeting
     * @param Committee $committee
     * @return Response
     * @internal param int $id
     */
    public function update(UpdateDelegateMeetingRequest $request, Committee $committee, Meeting $meeting)
    {
        MeetingDelegate::updateStatusAndReason($request->status, $request->refuse_reason, $meeting);
        MeetingMultimedia::createMultimedia($request->text,$meeting,$committee);
        MeetingDocument::updateDocumentsMeeting($meeting->id, $committee->id);
        self::sessionSuccess(__('committee::delegate_meeting.meeting_updated_successfully'));
        return redirect()->back();
    }

}
