<?php

namespace Modules\Committee\Observers;

use Modules\Committee\Entities\Committee;

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
        //
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
        // Notify Departments

        // Delete Relationships
        $committee->documents()->delete();
        $committee->participantDepartments()->detach();
        $committee->participantAdvisors()->detach();
        $committee->delegates()->detach();
    }
}
