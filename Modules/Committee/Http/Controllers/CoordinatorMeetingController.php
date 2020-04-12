<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Users\Entities\Delegate;

class CoordinatorMeetingController extends UserBaseController
{
    /**
     * Show the specified resource.
     * @param Committee $committee
     * @param Meeting $meeting
     * @return Response
     * @internal param int $id
     */
    public function show(Committee $committee, Meeting $meeting)
    {
        if (!$meeting->is_completed) {
            abort(403);
        }
        $delegates = Delegate::whereIn('parent_department_id', auth()->user()->coordinatorAuthorizedIds())->get();

        $meetingDepartments = $committee->participantDepartments()->with(['meetingDelegates' => function($query) use ($meeting){
            $query->where('meeting_id', $meeting->id);
        }])->whereIn('departments.id', auth()->user()->coordinatorAuthorizedIds())->get();

        return view('committee::meetings.coordinator.show', compact('meeting', 'committee', 'delegates', 'meetingDepartments'));
    }
}
