<?php

namespace Modules\Committee\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Committee\Notifications\CommitteeCreated;
use Modules\Committee\Notifications\SubmitLabelRequests;

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
        // Notify Participant Advisors
        foreach ($event->committee->participantAdvisors as $advisor) {
            $advisor->notify(new CommitteeCreated($event->committee));
        }
        // Notify Departments
        foreach ($event->committee->participantDepartmentsUsersUnique() as $user) {
            $user->notify(new SubmitLabelRequests($event->committee));
        }
    }
}
