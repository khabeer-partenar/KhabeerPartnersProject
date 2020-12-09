<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;
use Modules\SystemManagement\Rules\CheckCoordinatorParentDepartmentType;
use Modules\Users\Entities\User;
use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\SystemManagement\Rules\CheckDepartmentReference;
use Modules\SystemManagement\Rules\CheckDepartmentType;
use Modules\Users\Rules\CheckInCoordinatorJobs;

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
            'main_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType(Department::mainDepartment)],
            'parent_department_id' => ['required', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentType(Department::parentDepartment)],
            'direct_department' => ['nullable', 'string'],
            'national_id'          => ['required', new NationalIDRule, 'unique:'. User::table(). ',national_id,NULL,id,deleted_at,NULL'],
            'name'                 => ['required', new FilterStringRule, 'string'],
            'phone_number'         => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table() . ',phone_number,NULL,id,deleted_at,NULL'],
            'email'                => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table() . ',email,NULL,id,deleted_at,NULL'],
            'department_reference_id' => ['nullable', 'integer', new CheckDepartmentReference],
            'job_role_id'          => ['required', new CheckInCoordinatorJobs]
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
