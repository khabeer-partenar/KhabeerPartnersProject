<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Committee\Entities\Committee;
use Modules\Users\Entities\Coordinator;
use Modules\Committee\Notifications\NominationRememberNotification;
use Modules\Committee\Notifications\MeetingComeSoon;
use Modules\Committee\Entities\Meeting;
use Notification;
use Log;
class UrgentMeetingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urgent_meeting_soon:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification for urgent committee have departments not have nominations ,meetings having 48 hours to start ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $committees= Committee::urgentCommittee()->waitingDelegates()->get();
        foreach ($committees as $key => $committee) {

            $departmentsId = $committee->DepartmentsNotHaveNominationDelegates()->pluck('department_id')->toArray();
            $Coordinators = Coordinator::ParentDepartmentCoordinators($departmentsId)->get();
            Notification::send($Coordinators, new NominationRememberNotification($committee));

        }

        $meetings = Meeting::soonMeeting()->completed()->get();
        foreach ($meetings as $key => $meeting) {
            Notification::send($meeting->committee->delegates, new MeetingComeSoon($meeting->committee,$meeting));

        }

    }
}
