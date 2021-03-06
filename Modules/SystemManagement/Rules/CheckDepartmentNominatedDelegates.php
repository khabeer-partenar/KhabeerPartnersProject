<?php

namespace Modules\SystemManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Users\Entities\Delegate;

class CheckDepartmentNominatedDelegates implements Rule
{
    protected $delegates_ids;
protected $department_id;
protected  $committee_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($delegates_ids,$department_id,$committee_id)
    {
        $this->delegates_ids=$delegates_ids;
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
        $delegates_ids = Delegate::getDepartmentDelegatesNotInCommitteeIds($this->department_id,$this->committee_id);
        $resultArr = array_diff($value,$delegates_ids);
        if (count($resultArr) > 0) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.wrong choice');

    }
}
