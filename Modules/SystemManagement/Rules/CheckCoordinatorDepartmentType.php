<?php

namespace Modules\SystemManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;

class CheckCoordinatorDepartmentType implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */

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
            if (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
                $mainDepartmentsIds = array();
                $coordinator = Coordinator::find(auth()->user()->id);
                array_push($mainDepartmentsIds, $coordinator->main_department_id);
                $childrenMainDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('parent_id')->toArray();
                $finalMainDepartmentsIds = array_merge($mainDepartmentsIds, $childrenMainDepartments);

            } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
                $coordinator = Coordinator::find(auth()->user()->id);
                $finalMainDepartmentsIds = Department::where('id', $coordinator->main_department_id)->toArry();
            }
            return in_array((int) $value,$finalMainDepartmentsIds,true);
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
