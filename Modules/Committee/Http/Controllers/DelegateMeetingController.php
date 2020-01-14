<?php

namespace Modules\Committee\Http\Controllers;

use Modules\Committee\Entities\Meeting;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\MeetingDocument;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\MeetingMultimedia;
use Modules\Committee\Http\Requests\UpdateDelegateMeetingRequest;
use Modules\Users\Traits\SessionFlash;
use Illuminate\Http\Response;

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
    public function show(Committee $committee, Meeting $meeting)
    {
        $delegate = auth()->user()->delegate;

        $documentsByDelegate = $delegate->documents()->where('meeting_id', $meeting->id)->get();

        $meetingDelegate = $meeting->delegates()->where('delegate_id', auth()->id())->first();

        return view('committee::meetings.delegates.show', compact('meeting', 'documentsByDelegate', 'committee', 'meetingDelegate'));
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
