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
use Modules\Users\Rules\CheckDepartmentReference;
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
            'direct_department_id' => ['nullable', 'integer', new CheckDepartmentType(Department::directDepartment, false)],
            'national_id' => ['required', new NationalIDRule, Rule::unique(User::table())->ignore($coordinator->id)],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule, Rule::unique(User::table())->ignore($coordinator->id)],
            'email' => ['required', 'email', new ValidationGovEmailRule, Rule::unique(User::table())->ignore($coordinator->id)],
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
