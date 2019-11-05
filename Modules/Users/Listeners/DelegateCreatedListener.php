<?php

namespace Modules\Users\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;
use Modules\Users\Notifications\DelegateCreatedNotification;
use Modules\Users\Events\DelegateCreatedEvent;
use Modules\Users\Notifications\NotifyDelegatesOfAddetion;
use Illuminate\Support\Facades\Log;

class DelegateCreatedListener
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
    public function handle(DelegateCreatedEvent $event)
    {

        //
        // Notify Adivsors
        $event->committee->advisor->notify(new DelegateCreatedNotification($event->delegate,$event->committee));
        // Nofify Secretaries
        $advisor = User::find($event->committee->advisor_id);  // get secretaries by advisor id
        $secretaries = $advisor->secretaries()->get();
        foreach ($secretaries as $secretary)
        {
            $secretary->notify(new DelegateCreatedNotification($event->delegate,$event->committee));
        }

        // notify delegates
     // $delegate1 =  Delegate::find($event->delegate->id);
        $event->delegate->notify(new NotifyDelegatesOfAddetion($event->delegate,$event->committee));

    }
}
