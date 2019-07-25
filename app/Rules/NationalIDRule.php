<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalIDRule implements Rule
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
        return true;
        /*// Check if value is not numeric or 10 digits long
        if (!is_numeric($value) || strlen($value) != 10) {
            return false;
        }

        // Check if starting digit is not either 1 or 2
        if (substr($value, 0, 1) != 1 && substr($value, 0, 1) != 2) {
            return false;
        }

        // Do check sum
        $sum = 0;
        $num = str_split($value);

        for ($i = 0; $i < 10; $i++) {
            if ($i % 2 == 0) {
                $s = $num[$i] * 2;
                $sum += $s % 10 + floor($s / 10);
            }
            else {
                $sum += $num[$i];
            }
        }
        
        return ($sum % 10 == 0);*/
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.national_id');
    }
}
