<?php

namespace Modules\Users\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Committee\Entities\Committee;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;

class DelegateUpdatedEvent
{
    use SerializesModels;

    public $delegate;
    public $coordinator;
    public $committee;
    public $message;
    public $old_department;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Delegate $delegate,Coordinator $coordinator,Committee $committee,$message, $old_department)
    {
        $this->delegate = $delegate;
        $this->coordinator = $coordinator;
        $this->committee = $committee;
        $this->message = $message;
        $this->old_department = $old_department;

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
