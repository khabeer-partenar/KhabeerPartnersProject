<?php

namespace Modules\Users\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;

class CheckDepartmentType implements Rule
{
    protected $typeId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $department = Department::find($value);
        if (!$department) {
            return false;
        }
        return $department->type == $this->typeId;
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
