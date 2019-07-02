<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;
use Modules\Users\Entities\User;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\Users\Rules\CheckDepartmentReference;
use Modules\Users\Rules\CheckDepartmentType;

class SaveCoordinatorRequestByCo extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'direct_department_id' => ['nullable', 'integer', new CheckDepartmentType(Department::directDepartment, false)],
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table()],
            'name'                 => ['required', new FilterStringRule, 'string'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table()],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table()],
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
