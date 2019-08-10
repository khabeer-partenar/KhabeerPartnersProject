<?php

namespace Modules\Committee\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NominationDoneEvent implements ShouldQueue
{
    use SerializesModels;
    public $committee;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($committee)
    {
        $this->committee = $committee;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
