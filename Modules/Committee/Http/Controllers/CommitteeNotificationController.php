<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Notifications\CommitteeRemembered;
use Illuminate\Support\Facades\Notification;
use Modules\Committee\Notifications\MeetingComeSoon;

class CommitteeNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @return Response
     */
    public function sendUrgentCommiteeNotification(Committee $committee)
    {
        Notification::send($committee->meetings()->first()->delegates, new MeetingComeSoon($committee,$committee->meetings()->first()));
        dd('sad');
        $toBeNotifiedUsers = $committee->participantAdvisors->merge($committee->delegates)->merge($committee->participantDepartmentsCoordinators());
        if($toBeNotifiedUsers->count())

        Notification::send($toBeNotifiedUsers,new CommitteeRemembered($committee,$committee->meetings()->first()));
        return response()->json(['status' => 1,'message' => __('committee::notifications.notification_send_done')]);
    }
}
