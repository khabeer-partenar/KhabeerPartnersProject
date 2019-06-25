<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Department;
use Modules\Users\Entities\User;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\Users\Rules\CheckDepartmentType;

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
            'main_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType('1')],
            'parent_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType('2')],
            'direct_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id'], new CheckDepartmentType('3'),
            'national_id'          => ['required', new NationalIDRule, 'unique:'. Coordinator::table()],
            'name'                 => ['required', new FilterStringRule, 'string'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. Coordinator::table()],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. Coordinator::table()],
            'department_reference' => ['required', 'string']
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
