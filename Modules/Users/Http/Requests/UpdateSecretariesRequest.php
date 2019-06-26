<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Department;
use Modules\Users\Entities\User;

use App\Rules\NationalIDRule;
use App\Rules\FilterStringRule;
use App\Rules\ValidationPhoneNumberRule;
use App\Rules\ValidationGovEmailRule;

class UpdateSecretariesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'secretaries_ids'      => ['nullable', 'array'],
            'secretaries_ids.*'    => ['nullable', 'integer', 'exists:'. User::table() .',id'],
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
