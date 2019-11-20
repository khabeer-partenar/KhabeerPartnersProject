<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckFlag implements Rule
{
    private $table;
    private $flag;
    private $status;
    private $key;

    /**
     * Create a new rule instance.
     *
     * @param $table
     * @param $flag
     * @param bool $status
     * @param string $key
     */
    public function __construct($table, $flag, $status = true, $key = 'id')
    {
        $this->table = $table;
        $this->flag = $flag;
        $this->status = $status;
        $this->key = $key;
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
        return DB::table($this->table)->where($this->key, $value)->where($this->flag, $this->status)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.error with the :attribute');
    }
}
