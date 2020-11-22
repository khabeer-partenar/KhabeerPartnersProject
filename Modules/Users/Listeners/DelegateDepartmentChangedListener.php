<?php

namespace Modules\Users\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Users\Notifications\DelegateDepartmentChangedNotification;

class DelegateDepartmentChangedListener
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
        $event->coordinator->notify(new DelegateDepartmentChangedNotification($event->delegate,$event->committee,$event->message, $event->old_department));

    }
}
