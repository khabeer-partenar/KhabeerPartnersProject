<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;

class SaveUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'direct_department_id' => ['required', 'integer', 'exists:'. Department::table() .',id'],
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table()],
            'name'                 => ['required', new FilterStringRule, 'string'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table()],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table()],
            'job_role_id'          => ['required', 'integer', 'exists:'. Group::table() .',id'],
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