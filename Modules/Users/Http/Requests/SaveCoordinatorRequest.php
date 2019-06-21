<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;
use Modules\Users\Entities\User;

class SaveCoordinatorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'direct_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'national_id'          => 'required|national_id|unique:'. User::table(),
            'name'                 => 'required|filter_string|string',
            'phone_number'         => 'required|phone_number|unique:'. User::table(),
            'email'                => 'required|email|gov_email|unique:'. User::table(),
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
