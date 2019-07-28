<?php

namespace Modules\Committee\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Employee;

class PresidentIsChairman implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $presidentId = \Request::post('president_id');
        if ($presidentId && $value[0] == null) {
            $president = Employee::where('id', $presidentId)->first();
            if ($president) {
                return $president->jobRole->key == 'chairman_of_the_commission' ? false:true;
            }
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
        return __('validation.is_president_chairman');

    }
}
