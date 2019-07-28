<?php

namespace Modules\Committee\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Committee\Entities\Committee;

class CommitteeCreatedEvent implements ShouldQueue
{
    use SerializesModels;

    public $committee;

    /**
     * Create a new event instance.
     *
     * @param $committee
     */
    public function __construct($committee)
    {
        $this->committee = $committee;
    }
}
