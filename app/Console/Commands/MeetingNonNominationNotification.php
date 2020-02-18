<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Committee\Entities\Meeting;
use Modules\Users\Entities\Coordinator;
use Modules\Committee\Notifications\meetingDoneWithoutNomination;
use Carbon\Carbon;
use Notification;
use Log;
class MeetingNonNominationNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting_not_have_nominations:cron';

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
        $meetings = Meeting::where('from', '>=', Carbon::today())
                            ->where('to', '<=',  Carbon::now())->with('committee')->get();
        foreach ($meetings as $key => $meeting) {
            $departments = $meeting->committee->DepartmentsNotHaveNominationDelegates();
            $department_reference_ids = $departments->pluck('reference_id','department_id')->toArray();
            $department_ids = $departments->pluck('department_id','department_id')->toArray();
             $Coordinators = Coordinator::ParentDepartmentCoordinators(array_replace($department_ids,array_filter($department_reference_ids)))->mainCoordinator()->get();
             Notification::send($Coordinators, new meetingDoneWithoutNomination($meeting->committee));

        }  
              
    }
}
