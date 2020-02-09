<?php

namespace Modules\Committee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FullName;
use App\Rules\NationalIDRule;

class DelegateDriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', new FullName],
            'national_id' => ['required', new NationalIDRule, 'unique:delegate_driver,national_id'],
            'nationality' => 'required',
            'religion_id' => 'required'
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
