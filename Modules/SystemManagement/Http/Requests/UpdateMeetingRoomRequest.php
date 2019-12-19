<?php

namespace Modules\SystemManagement\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Core\Entities\City;
use App\Rules\FilterStringRule;

class UpdateMeetingRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $meetingRoom = $request->meetingRoom;

        return [
            'name' => ['required', 'max:255', new FilterStringRule, 'unique:'. MeetingRoom::table() . ',name,' . $meetingRoom->id],
            'city_id' => ['required', 'integer', 'exists:'. City::table(). ',id'],
            'capacity' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'integer', 'in:0,1'],
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