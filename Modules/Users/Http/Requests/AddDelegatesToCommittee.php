<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\SystemManagement\Rules\CheckDepartmentNominatedDelegates;

class AddDelegatesToCommittee extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delegates_ids' => ['required',  new CheckDepartmentNominatedDelegates(request()->delegates_ids,request()->department_id,request()->committee_id)]
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
