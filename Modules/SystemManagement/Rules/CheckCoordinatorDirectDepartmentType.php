<?php

namespace Modules\SystemManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;
use Symfony\Component\HttpFoundation\ParameterBag;

class CheckCoordinatorDirectDepartmentType implements Rule
{
protected  $parent_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parent_id)
    {
        $this->parent_id =$parent_id;
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
        if (in_array(auth()->user()->authorizedApps->key, [Coordinator::MAIN_CO_JOB, Coordinator::NORMAL_CO_JOB])) {

            $directDepartments = Department::where('parent_id',$this->parent_id)->pluck('id')->toArray();
            return in_array((int) $value,$directDepartments,true);
        }
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
