<?php

namespace Modules\Users\Observers;

use Carbon\Carbon;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDelegate;
use Modules\Core\Traits\Log;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Events\DelegateUpdatedEvent;
use Mpdf\Tag\Del;


class DelegateObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  $committee
     * @return void
     */
    public function created(Delegate $delegate)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param $committee
     * @return void
     */
    public function updated(Delegate $delegate)
    {
        $oldParentDepartmentId = $delegate->getOriginal('parent_department_id');
        if ($oldParentDepartmentId !== $delegate->parent_department_id) {
            $nominations = CommitteeDelegate::getDepartmentNominations($oldParentDepartmentId, $delegate->id);
            if (optional($nominations)) {


                foreach ($nominations as $nomination) {


                    $nominationsCount = CommitteeDelegate::getCommitteeDepartmentNominationTotal($nomination->committee_id, $nomination->nominated_department_id);

                    $delegate->log('delegate_department_changed');

                    CommitteeDelegate::where('user_id', $nomination->user_id)
                        ->where('nominated_department_id', $oldParentDepartmentId)
                        ->where('committee_id', $nomination->committee_id)->delete();

                    $message = '';
                    if ($nominationsCount == 1) {
                        $message = __('users::delegates.delegate_department_changed2');
                    }
                    $delegate = Delegate::findOrFail($nomination->user_id);
                    $coordinator = Coordinator::findOrFail($nomination->coordinator_id);
                    $committee = Committee::findOrFail($nomination->committee_id);

                    event(new DelegateUpdatedEvent($delegate,$coordinator,$committee,$message));

                }
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param $committee
     * @return void
     */
    public function deleted(Delegate $delegate)
    {

    }
}
