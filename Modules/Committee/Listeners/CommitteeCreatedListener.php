<?php

namespace Modules\Committee\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Committee\Notifications\CommitteeCreated;
use Modules\Committee\Notifications\SubmitLabelRequests;
use Modules\Committee\Notifications\MeetingCompleteDataRemember;
use Notification;

class CommitteeCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommitteeCreatedEvent $event)
    {
        // Notify Adivsors
        $event->committee->advisor->notify(new CommitteeCreated($event->committee));
        $toBeNotifiedUsers = $event->committee->advisor->secretaries;
        //Notification::send($toBeNotifiedUsers, new MeetingCompleteDataRemember($event->committee,$event->committee->meetings()->first()));

    }
}
