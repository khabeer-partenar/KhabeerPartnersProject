<?php

namespace Modules\SystemManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Entities\Department;

use App\Rules\FilterStringRule;

class SaveDepartmentTypeCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dept_name'   => ['required', 'max:255', new FilterStringRule, 'unique:'. Department::table() . ',name'],
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