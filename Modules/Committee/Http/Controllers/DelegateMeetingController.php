<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Request;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\Nationality;
use Modules\Committee\Entities\Religion;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Multimedia;
use Modules\Committee\Http\Requests\MeetingDelegateNominateRequest;
use Modules\Committee\Http\Requests\UpdateDelegateMeetingRequest;
use Modules\Users\Entities\Delegate;
use Modules\Users\Traits\SessionFlash;
use Illuminate\Http\Response;

class DelegateMeetingController extends UserBaseController
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
                ])->where('delegate_id', auth()->id());
            }
        ]);

        $nationalities = Nationality::all();
        $religions = Religion::all();

        return view('committee::meetings.delegates.show', compact('meeting', 'nationalities', 'committee', 'religions'));
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
        $meeting->updateStatusAndReason($request);
        Multimedia::createMultimedia($request->text, $committee->id, $meeting->id);
        self::sessionSuccess(__('committee::delegate_meeting.meeting_updated_successfully'));
        return redirect()->route('committee.meetings', compact('committee'));
    }

    /**
     * Edit Meeting Nominations By Coordinator
     * @param MeetingDelegateNominateRequest $request
     * @param Committee $committee
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function nominate(MeetingDelegateNominateRequest $request, Committee $committee, Meeting $meeting)
    {
        $meeting->departments()->detach($request->department_id);
        if ($request->delegate_id != 0) {
            $delegate = Delegate::where('id', $request->delegate_id)->first();
            $meeting->delegatesPivot()->create([
                'delegate_id' => $delegate->id,
                'department_id' => $request->department_id
            ]);
        }
        return \response()->json([]);
    }
}
