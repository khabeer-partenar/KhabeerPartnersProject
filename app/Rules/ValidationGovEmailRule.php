<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationGovEmailRule implements Rule
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
        $email = explode('.', $value);

        if(count($email) < 3) {
            return false;
        }

        $email = $email[count($email)-2] .'.'. $email[count($email)-1];
    
        return $email == 'gov.sa';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.gov_email');
    }
}
