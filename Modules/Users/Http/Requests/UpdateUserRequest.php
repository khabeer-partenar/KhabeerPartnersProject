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

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'main_department_id'   => 'required|integer|exists:'. Department::table() .',id',
            // 'parent_department_id' => 'required|integer|exists:'. Department::table() .',id',
            'direct_department_id' => ['required', 'integer', 'exists:'. Department::table() .',id'],
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table() .',national_id,' . $this->id],
            'name'                 => ['required', new FilterStringRule, 'string'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table() . ',phone_number,' . $this->id],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table() . ',email,' . $this->id],
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