<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Committee\Entities\Committee;
use Log;
class UrgentMeetingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification for urgent committee meetings having 48 hours to start ';

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
        $committees= Committee::urgentCommittee()->get();
        foreach ($committees as $key => $committee) {
            Log::info($committee->participantDepartments()->delegates);
        }
    }
}
