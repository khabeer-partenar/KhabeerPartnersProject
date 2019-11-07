<?php


namespace Modules\SystemManagement\Rules;
use Illuminate\Contracts\Validation\Rule;
use Modules\Committee\Entities\CommitteeDelegate;
use Modules\Users\Entities\Delegate;

class CheckMainCoordinatorNominations implements Rule
{
    protected $department_id;
    protected  $committee_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($department_id,$committee_id)
    {
        $this->department_id=$department_id;
        $this->committee_id=$committee_id;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result  = CommitteeDelegate::checkIfMainCoordinatorNominateDelegates($this->department_id,$this->committee_id);
        if ($result==true) return true;
        return flase;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.main_coordinator_nominate_delegates');

    }
}