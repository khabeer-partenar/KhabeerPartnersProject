<?php

namespace Modules\Committee\Http\Requests;

use App\Rules\FilterStringRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\User;

class SaveCommitteeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resource_staff_number' => 'required',
            'resource_at' => 'required|date',
            'resource_by' => ['required', 'exists:'. Department::table(). ',id'],
            'treatment_number' => 'required',
            'treatment_time' => 'required|date',
            'treatment_type_id' => ['required', 'exists:'. TreatmentType::table(). ',id'],
            'treatment_urgency_id' => ['required', 'exists:'. TreatmentUrgency::table(). ',id'],
            'treatment_importance_id' => ['required', 'exists:'. TreatmentImportance::table(). ',id'],
            'source_of_study_id' => ['required', 'exists:'. Department::table(). ',id'],
            'recommendation_number' => 'required',
            'recommended_by_id' => ['required', 'exists:'. Department::table(). ',id'],
            'recommended_at' => 'required',
            'subject' => ['required', 'string', new FilterStringRule],
            'first_meeting_at' => 'required|date', // + today
            'tasks' => ['nullable', 'string', new FilterStringRule],
            'president_id' => ['required', 'exists:'. User::table(). ',id'],
            'advisor_id' => ['required', 'exists:'. User::table(). ',id'],
            'participant_advisors' => 'required',
            'members_count' => 'nullable|integer',
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
