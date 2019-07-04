<?php

namespace Modules\Users\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;

class CheckInCoordinatorJobs implements Rule
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
        $coordinatorJobs = Group::whereIn('key', [Coordinator::MAIN_CO_JOB, Coordinator::NORMAL_CO_JOB])->pluck('id')->toArray();
        return in_array($value, $coordinatorJobs);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('users::coordinators.error happened');
    }
}
