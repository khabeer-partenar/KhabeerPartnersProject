<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class OverlappingDates implements Rule
{
    private $from;
    private $to;
    private $model;
    private $key;
    private $dateFormat;

    /**
     * Create a new rule instance.
     *
     * @param $from
     * @param $to
     * @param Model $model
     * @param null $key
     * @param string $fromFormat
     * @param string $toFormat
     * @param string $format
     * @internal param $day
     */
    public function __construct($from, $to, Model $model , $key = null, $format = 'm/d/Y')
    {
        $this->from = $from;
        $this->to = $to;
        $this->model = $model;
        $this->key = $key;
        $this->dateFormat = $format;
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
        if (!$value || !\Request::post($this->from) || !\Request::post($this->to)) {
            return false;
        }
        try {
            $day = Carbon::createFromFormat($this->dateFormat, $value)->startOfDay();
            $from = Carbon::parse(\Request::post($this->from))->diffInSeconds(Carbon::today());
            $to = Carbon::parse(\Request::post($this->to))->diffInSeconds(Carbon::today());
            $fromDate = $day->copy()->addSeconds($from);
            $toDate = $day->copy()->addSeconds($to);
            $query = $this->model->query();

            if ($this->key && \Request::post($this->key)){
                $query->where($this->key, \Request::post($this->key));
            }

            $count = $query->where(function ($query) use ($fromDate, $toDate) {
                    $query
                        ->whereBetween($this->from, [$fromDate, $toDate])
                        ->orWhereBetween($this->to, [$fromDate, $toDate]);
                })->count();

            if ($count > 0) {
                return false;
            }

            return true;
        } catch (InvalidDateException $exception) {
            throw new $exception;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'التاريخ متداخل مع تاريخ إجتماع آخر في هذه الصالة';
    }
}
