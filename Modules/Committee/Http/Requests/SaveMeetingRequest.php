<?php

namespace Modules\Committee\Http\Requests;

use App\Rules\CheckFlag;
use App\Rules\OverlappingDates;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Committee\Entities\Meeting;
use Modules\Committee\Entities\MeetingType;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;

class SaveMeetingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason' => 'required',
            'room_id' => [
                'required',
                'exists:'. MeetingRoom::table(). ',id',
                new CheckFlag(MeetingRoom::table(), 'status')
            ],
            'type_id' => [
                'required',
                'exists:'. MeetingType::table(). ',id',
                new CheckFlag(MeetingType::table(), 'active')
            ],
            'at' => [
                'required',
                'date_format:m/d/Y',
                'after_or_equal:today',
                new OverlappingDates('from', 'to', new Meeting(), 'room_id', 'meeting_id')
            ],
            'from' => ['required', 'date_format:G:i'],
            'to' => ['required', 'date_format:G:i', 'after:from'],
            'delegates.*' => ['nullable', 'integer', 'exists:'. Delegate::table() .',id'],
            'participantAdvisors.*' => ['nullable', 'integer', 'exists:'. User::table() .',id'],
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
