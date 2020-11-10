<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $employee = $request->employee;
        return [
            'direct_department_id' => ['required', 'integer', 'exists:'. Department::table() .',id'],
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table() . ',national_id,' . $employee->id],
            'name'                 => ['required', new FilterStringRule, 'string', 'max:255'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table() . ',phone_number,' . $employee->id .',id,deleted_at,NULL'],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table() . ',email,' . $employee->id .',id,deleted_at,NULL'],
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
