<?php

namespace Modules\Committee\Http\Controllers;

use App\Http\Controllers\UserBaseController;
use Illuminate\Http\Response;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\Meeting;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;
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
        $delegates = $committee->getDelegatesWithDetails();
        $mainDepartments = Department::getDepartments();
        $delegateJobs = Group::whereIn('key', [Delegate::JOB])->get(['id', 'name', 'key']);
        $committee->load('participantAdvisors', 'participantDepartments', 'documents', 'view');
        $meeting->load(['delegates' => function($query) {
            $query->whereIn('parent_department_id', auth()->user()->coordinatorAuthorizedIds())->with('department');
        }]);
        return view('committee::meetings.coordinator.show', compact('meeting', 'committee', 'delegates', 'mainDepartments', 'delegateJobs'));
    }
}
