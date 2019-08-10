<?php

namespace Modules\Committee\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Committee\Events\NominationDoneEvent;
use Modules\Committee\Notifications\NominationDoneNotification;
use Modules\Users\Entities\User;


class NominationDoneListener
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
    public function handle(NominationDoneEvent $event)
    {
        $advisor = User::find($event->committee->advisor_id);  // get secretaries by advisor id
        $secretaries = $advisor->secretaries()->get();
        foreach ($secretaries as $secretary)
        {
            $secretary->notify(new NominationDoneNotification($event->committee));
        }

    }
}
