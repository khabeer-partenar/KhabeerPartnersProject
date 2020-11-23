<?php

namespace Modules\Committee\Observers;

use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingDelegate;

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
        $delegates = $meeting->delegates();
        $old_meeting = $meeting->getOriginal();

        if($old_meeting['type_id'] === Meeting::FIRST )
        {
            if($old_meeting['completed'] === Meeting::NONCOMPLETE)
                MeetingDelegate::MeetingUpdateDelegatesNotifications(request()->delegates,$meeting->delegates,$meeting, 'created');
            elseif($old_meeting['from'] !== $meeting->from || $old_meeting['to'] !== $meeting->to)
                MeetingDelegate::MeetingUpdateDelegatesNotifications(request()->delegates,$meeting->delegates,$meeting, 'changed');
        }
        else
            if($old_meeting['from'] !== $meeting->from || $old_meeting['to'] !== $meeting->to)
                MeetingDelegate::MeetingUpdateDelegatesNotifications(request()->delegates,$meeting->delegates,$meeting, 'changed');

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
