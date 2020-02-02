<?php

namespace Modules\Committee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;

class SaveMeetingAttendance extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'participantAdvisors' => ['array'],
            'delegates' => ['array'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
