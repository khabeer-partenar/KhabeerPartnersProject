<?php

namespace Modules\Users\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SystemManagement\Entities\Department;

class CheckDepartmentType implements Rule
{
    protected $typeId;
    protected $required;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($typeId, $required = true)
    {
        $this->typeId = $typeId;
        $this->required = $required;
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
            if (!$this->required) {
                return true;
            }
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
