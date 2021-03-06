<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckIfDateIsAfter implements Rule
{
    private $date;
    private $translationPath;
    private $format;
    private $secondFormat;

    /**
     * Create a new rule instance.
     *
     * @param $date
     * @param $translationPath
     * @param string $format
     * @param string $secondFormat
     * @internal param $attribute
     */
    public function __construct($date, $translationPath, $format = 'm/d/Y', $secondFormat = 'm/d/Y')
    {
        $this->date = $date;
        $this->translationPath = $translationPath;
        $this->format = $format;
        $this->secondFormat = $secondFormat;
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
        if (!$value || !\Request::post($this->date)) {
            return false;
        } else {
            $newDate = Carbon::createFromFormat($this->format, $value);
            $olderDate = Carbon::createFromFormat($this->secondFormat, \Request::post($this->date));
            return $newDate->greaterThan($olderDate);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.if_date_is_after', ['after' => __("$this->translationPath.$this->date")]);
    }
}
