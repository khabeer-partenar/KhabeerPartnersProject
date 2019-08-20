<?php

use Carbon\Carbon;
use Modules\Users\Entities\Delegate;
use Modules\Users\Notifications\DelegateCreated;


class DelegateObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  $committee
     * @return void
     */
    public function created(Committee $committee)
    {

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

    }
}
