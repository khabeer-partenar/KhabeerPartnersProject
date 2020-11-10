<?php


namespace Modules\Users\Http\Requests;


use App\Rules\FilterStringRule;
use App\Rules\NationalIDRule;
use App\Rules\ValidationGovEmailRule;
use App\Rules\ValidationPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\SystemManagement\Entities\Department;
use Modules\SystemManagement\Rules\CheckCoordinatorDepartmentType;
use Modules\SystemManagement\Rules\CheckCoordinatorDirectDepartmentType;
use Modules\SystemManagement\Rules\CheckCoordinatorParentDepartmentType;
use Modules\SystemManagement\Rules\CheckDepartmentReference;
use Modules\SystemManagement\Rules\CheckMainCoordinatorNominations;
use Modules\Users\Entities\User;
use Modules\Users\Rules\CheckInDelegateJobs;

class UpdateDelegateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $delegate = $request->delegate;
        return [
            'parent_department_id' =>   ['required','integer','exists:'. Department::table(). ',id',  new CheckMainCoordinatorNominations(request()->parent_department_id,request()->committee_id)
                , new CheckCoordinatorParentDepartmentType($request->main_department_id)],
            'main_department_id' => ['required', 'integer','exists:'. Department::table(). ',id',  new CheckCoordinatorDepartmentType],
            'direct_department_id' => ['nullable', 'integer', new CheckCoordinatorDirectDepartmentType(request()->parent_department_id)],
            'job_title' => ['required'],
            'national_id' => ['required', new NationalIDRule, Rule::unique(User::table())->ignore($delegate->id)],
            'name' => ['required', new FilterStringRule, 'string'],
            'phone_number' => ['required', new ValidationPhoneNumberRule, 'unique:'. User::table() . ',phone_number,' . $delegate->id .',id,deleted_at,NULL'],
            'email' => ['required', 'email', new ValidationGovEmailRule, 'unique:'. User::table() . ',email,' . $delegate->id .',id,deleted_at,NULL'],
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
