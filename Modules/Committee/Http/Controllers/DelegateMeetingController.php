<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee, Meeting $meeting)
    {
         $documents = MeetingDocument::where('user_id', auth()->id())
             ->where('committee_id', $committee->id)
             ->whereNull('meeting_id')->get();
         $meeting_delgate= MeetingDelegate::where('delegate_id',26)
                            ->where('meeting_id',$meeting->id)->first();
        return view('committee::meetings.delegates.show', compact('meeting', 'documents','committee','meeting_delgate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function update(UpdateDelegateMeetingRequest $request,Committee $committee, Meeting $meeting)
    {
        MeetingDelegate::updateStatusAndReason($request->status, $request->refuse_reason, $meeting);
        MeetingMultimedia::createMultimedia($request->text,$meeting,$committee);
        MeetingDocument::updateDocumentsMeeting($meeting->id, $committee->id);
        self::sessionSuccess(__('committee::delegate_meeting.meeting_updated_successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
