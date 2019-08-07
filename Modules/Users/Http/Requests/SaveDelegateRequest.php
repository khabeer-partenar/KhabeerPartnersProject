<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\User;
use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\SystemManagement\Rules\CheckDepartmentReference;
use Modules\SystemManagement\Rules\CheckDepartmentType;
use Modules\Users\Rules\CheckInDelegateJobs;

class SaveDelegateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /*return [
            'main_department_id' => ['required', 'integer'],
            'parent_department_id' => ['required', 'integer'],
            'direct_department_id' => ['nullable', 'integer'],
            'national_id'          => ['required',
            'name'                 => ['required'],
            'phone_number'         => ['required'],
            'email'                => ['required', 'email'],
            'department_reference_id' => ['nullable', 'integer'],
            'job_role_id'          => ['required']]
        ];*/

       /* return [
            'main_department_id' => ['required', 'integer', 'exists:' . Department::table() . ',id', new CheckDepartmentType(Department::mainDepartment)],
            'parent_department_id' => ['required', 'integer', 'exists:' . Department::table() . ',id', new CheckDepartmentType(Department::parentDepartment)],
            'direct_department_id' => ['nullable', 'integer', new CheckDepartmentType(Department::directDepartment, false)],
            'job_title' => ['required'],
            'national_id' => ['required', new NationalIDRule, 'unique:' . User::table()],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule, 'unique:' . User::table()],
            'email' => ['required', 'email', new ValidationGovEmailRule, 'unique:' . User::table()],
            'department_reference_id' => ['nullable', 'integer', new CheckDepartmentReference],
            'job_role_id' => ['required', new CheckInDelegateJobs]
        ];*/

        return [
            'main_department_id' => ['required', 'integer', 'exists:' . Department::table() . ',id', new CheckDepartmentType(Department::mainDepartment)],
            'parent_department_id' => ['required', 'integer', 'exists:' . Department::table() . ',id', new CheckDepartmentType(Department::parentDepartment)],
            'direct_department_id' => ['nullable', 'integer', new CheckDepartmentType(Department::directDepartment, false)],
            'job_title' => ['required'],
            'national_id' => ['required', new NationalIDRule],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule],
            'email' => ['required', 'email', new ValidationGovEmailRule],
            'department_reference_id' => ['nullable', 'integer', new CheckDepartmentReference],
            'job_role_id' => ['required', new CheckInDelegateJobs]
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
