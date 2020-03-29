<?php

namespace Modules\SystemManagement\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Employee;

use App\Rules\FilterStringRule;
use Modules\SystemManagement\Rules\CheckDepartmentType;
use Modules\SystemManagement\Rules\CheckDepartmentIsReferenceType;
use App\Rules\ValidationGovEmailRule;

class UpdateDepartmentAuthoritiesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $department = $request->department;

        return [
            'department_name'   => ['required', 'max:255', new FilterStringRule, 'unique:'. Department::table() . ',name,' . $department->id],
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