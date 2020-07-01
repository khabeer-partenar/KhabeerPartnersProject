<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;
use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;

class SaveEmployeeRequest extends FormRequest
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
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table() . ',deleted_at,NULL'],
            'name'                 => ['required', new FilterStringRule, 'string', 'max:255'],
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