<?php

namespace Modules\SystemManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;

class CheckCoordinatorParentDepartmentType implements Rule
{
    protected $main_deparment_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($main_deparment_id)
    {
        $this->main_deparment_id=$main_deparment_id;
        //
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
        $departments = Department::GetDepartmentsWithRefWithoutPrepend($this->main_deparment_id)->pluck('id')->toArray();
        return in_array((int) $value,$departments,true);
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
