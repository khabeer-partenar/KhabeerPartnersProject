<?php

namespace Modules\Committee\Observers;

use Modules\Committee\Entities\Meeting;

class MeetingObserver
{
    /**
     * Handle the meeting "created" event.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function created(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "updated" event.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function updated(Meeting $meeting)
    {
        dd($meeting->getAttributes());
    }

    /**
     * Handle the meeting "deleted" event.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function deleted(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "restored" event.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function restored(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "force deleted" event.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function forceDeleted(Meeting $meeting)
    {
        //
    }
}
