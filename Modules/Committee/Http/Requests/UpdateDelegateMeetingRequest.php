<?php

namespace Modules\Committee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Committee\Entities\MeetingDelegate;

class UpdateDelegateMeetingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'=>['integer','nullable',Rule::in(array(MeetingDelegate::INVITED,MeetingDelegate::REJECTED,MeetingDelegate::ACCEPTED))],
            'driver_id' => ['required_if:has_driver,1'],
            'refuse_reason' => ['required_if:status,'.MeetingDelegate::REJECTED,'max:191'],
            'text.*'=>'max:191',
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
    public function messages()
    {
        return [
            'refuse_reason.required_if' => 'سبب الإعتذار مطلوب',
            'refuse_reason.max'=>'نص سبب الإعتذار كبير جدا',
            'text.*.max'=>'نص المرئيات كبير جدا'
        ];
    }
}
