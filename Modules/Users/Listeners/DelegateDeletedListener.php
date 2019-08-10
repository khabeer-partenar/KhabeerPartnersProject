<?php

namespace Modules\Users\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Committee\Entities\Committee;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;
use Modules\Users\Notifications\NotifyDeletedDelegate;
use Modules\Users\Events\DelegateDeletedEvent;
use Illuminate\Support\Facades\Log;

class DelegateDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Notify Adivsors
        $committee = Committee::find($event->committee_id)->first();
        $committee->advisor->notify(new NotifyDeletedDelegate($event->delegate,$committee,$event->reason));
        // Nofify Secretaries
        $advisor = User::find($committee->advisor_id);  // get secretaries by advisor id
        $secretaries = $advisor->secretaries()->get();
        foreach ($secretaries as $secretary)
        {
            $secretary->notify(new NotifyDeletedDelegate($event->delegate,$committee,$event->reason));
        }
        // notify delegates
        $event->delegate->notify(new NotifyDeletedDelegate($event->delegate,$committee,$event->reason));

    }
}
