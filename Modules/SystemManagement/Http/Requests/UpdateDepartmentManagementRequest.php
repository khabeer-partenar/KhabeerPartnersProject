<?php

namespace Modules\SystemManagement\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;

use App\Rules\FilterStringRule;
use Modules\SystemManagement\Rules\CheckDepartmentIsReferenceType;
use App\Rules\ValidationGovEmailRule;

class UpdateDepartmentManagementRequest extends FormRequest
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
            'name' => ['required', 'max:255', new FilterStringRule, 'unique:'. Department::table() . ',name,'. $department->id],
            'telephone' => ['nullable', 'numeric'],
            'address' => ['nullable', 'max:255', new FilterStringRule],
            'email' => ['nullable', 'email', new ValidationGovEmailRule],
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