<?php

namespace Modules\Users\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;


class DelegateDeletedEvent implements ShouldQueue
{
    use SerializesModels;
    public $delegate;
    public $committee_id;
    public $reason;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($delegate, $committee_id,$reason)
    {
        $this->delegate = $delegate;
        $this->committee_id = $committee_id;
        $this->reason = $reason;

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
