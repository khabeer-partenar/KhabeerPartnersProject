<?php

namespace Modules\Users\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class DelegateCreatedEvent implements ShouldQueue
{
    use SerializesModels;
    public $delegate;
    public $committee;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($delegate, $committee)
    {
        $this->delegate = $delegate;
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
