<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Department;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\Users\Rules\CheckDepartmentType;

class UpdateCoordinatorRequestByCo extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $coordinator = $request->coordinator;
        return [
//            'main_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType('1')],
//            'parent_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType('2')],
            'direct_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id'], new CheckDepartmentType('3'),
            'national_id' => ['required', new NationalIDRule, Rule::unique(User::table())->ignore($coordinator->id)],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule, Rule::unique(User::table())->ignore($coordinator->id)],
            'email' => ['required', 'email', new ValidationGovEmailRule, Rule::unique(User::table())->ignore($coordinator->id)],
//            'department_reference' => ['required', 'string']
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
