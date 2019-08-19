<?php

namespace Modules\SystemManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;;

class CheckDepartmentReference implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;

        if (!$value) {
            return true;
        }
        $parentId = \Request::input('parent_department_id');
        $parentDepartment = Department::where(['id' => $parentId, 'reference_id' => $value])->first();
        return isset($parentDepartment);
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
