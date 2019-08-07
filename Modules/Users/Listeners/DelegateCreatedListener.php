<?php

namespace Modules\Users\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Users\Notifications\DelegateCreatedNotification;
use Modules\Users\Events\DelegateCreatedEvent;


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
        //$event->committee->secretary->notify(new DelegateCreatedNotification($event->delegate,$event->committee));

    }
}
