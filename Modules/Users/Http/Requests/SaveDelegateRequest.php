<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\User;
use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;
use Modules\SystemManagement\Rules\CheckDepartmentReference;
use Modules\SystemManagement\Rules\CheckDepartmentType;
use Modules\SystemManagement\Rules\CheckCoordinatorDepartmentType;
use Modules\SystemManagement\Rules\CheckCoordinatorParentDepartmentType;
use Modules\SystemManagement\Rules\CheckCoordinatorDirectDepartmentType;


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
        return [
            'main_department_id' => ['required', 'integer',  new CheckCoordinatorDepartmentType],
            'parent_department_id' => ['required', 'integer', new CheckCoordinatorParentDepartmentType],
            'direct_department_id' => ['nullable', 'integer', new CheckCoordinatorDirectDepartmentType(request()->parent_department_id)],
            'job_title' => ['required'],
            'national_id' => ['required', new NationalIDRule, 'unique:' . User::table()],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule, 'unique:' . User::table()],
            'email' => ['required', 'email', new ValidationGovEmailRule, 'unique:' . User::table()],
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
