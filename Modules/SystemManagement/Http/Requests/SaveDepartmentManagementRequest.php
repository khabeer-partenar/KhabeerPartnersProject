<?php

namespace Modules\SystemManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;

use App\Rules\FilterStringRule;
use Modules\SystemManagement\Rules\CheckDepartmentType;
use Modules\SystemManagement\Rules\CheckDepartmentIsReferenceType;
use App\Rules\ValidationGovEmailRule;

class SaveDepartmentManagementRequest extends FormRequest
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
            'name' => ['required', 'max:255', new FilterStringRule, 'unique:'. Department::table() . ',name,NULL,id,deleted_at,NULL'],
            'telephone' => ['nullable', 'numeric'],
            'address' => ['nullable', 'max:255', new FilterStringRule],
            'email' => ['nullable', 'email', new ValidationGovEmailRule],
            'reference_id' => ['required_without:is_reference', 'integer', 'exists:'. Department::table(). ',id', new CheckDepartmentIsReferenceType(Department::parentDepartment)],
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
