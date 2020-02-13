<?php

namespace Modules\Committee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Committee\Entities\Committee;
use Modules\Users\Entities\Delegate;
use Modules\Committee\Notifications\CommitteeRemembered;
use Notification;

class CommitteeNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Committee $committee
     * @return Response
     */
    public function sendUrgentCommiteeNotification(Committee $committee)
    {        
        $toBeNotifiedUsers = $committee->participantAdvisors->merge($committee->delegates)->merge($committee->participantDepartmentsCoordinators());
        if($toBeNotifiedUsers->count())
            Notification::send($committee->delegates,new CommitteeRemembered($committee));
        return response()->json(['status' => 1,'message' => __('committee::notifications.notification_send_done')]);
    }
}
