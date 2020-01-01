<?php

namespace Modules\Committee\Observers;

use Carbon\Carbon;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Notifications\CommitteeDeleted;

class CommitteeObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  $committee
     * @return void
     */
    public function created(Committee $committee)
    {
        $hijriDate = Carbon::parse($committee->created_at_hijri);
        $committee->uuid = $hijriDate->year . '-' . $committee->id;
        $committee->save();
    }

    /**
     * Handle the User "retrieved" event.
     *
     * @param $committee
     * @return void
     */
    public function retrieved(Committee $committee)
    {
        //dd("retrieved");
    }

    /**
     * Handle the User "updated" event.
     *
     * @param $committee
     * @return void
     */
    public function updated(Committee $committee)
    {

    }

    /**
     * Handle the User "deleted" event.
     *
     * @param $committee
     * @return void
     */
    public function deleted(Committee $committee)
    {
        // Notify With deletion
        $committee->advisor->notify(new CommitteeDeleted($committee));
        foreach ($committee->participantAdvisors as $advisor) {
            $advisor->notify(new CommitteeDeleted($committee));
        }
        foreach ($committee->participantDepartmentsUsersUnique() as $user) {
            $user->notify(new CommitteeDeleted($committee));
        }
        // Delete Relationships
        $committee->documents()->delete();
        $committee->participantDepartments()->detach();
        $committee->participantAdvisors()->detach();
        $committee->delegates()->detach();
    }
}
