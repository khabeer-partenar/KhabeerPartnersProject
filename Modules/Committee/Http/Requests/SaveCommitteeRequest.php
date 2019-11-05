<?php

namespace Modules\Committee\Http\Requests;

use App\Rules\CheckIfDateIsAfter;
use App\Rules\FilterStringRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Committee\Entities\TreatmentImportance;
use Modules\Committee\Entities\TreatmentType;
use Modules\Committee\Entities\TreatmentUrgency;
use Modules\Committee\Rules\PresidentIsChairman;
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
            'treatment_number' => 'required|integer',
            'treatment_time' => 'required|date',
            'treatment_type_id' => ['required', 'exists:'. TreatmentType::table(). ',id'],
            'treatment_urgency_id' => ['required', 'exists:'. TreatmentUrgency::table(). ',id'],
            'treatment_importance_id' => ['required', 'exists:'. TreatmentImportance::table(). ',id'],
            'source_of_study_id' => ['required', 'exists:'. Department::table(). ',id'],
            'recommendation_number' => 'required',
            'recommended_by_id' => ['required', 'exists:'. Department::table(). ',id'],
            'recommended_at' => 'required|date',
            'subject' => ['required', 'string', new FilterStringRule],
            'first_meeting_at' => [
                'required',
                'date',
                'after:today',
                new CheckIfDateIsAfter('treatment_time', 'committee::committees'),
                new CheckIfDateIsAfter('resource_at', 'committee::committees')
            ],
            'tasks' => ['nullable', 'string', new FilterStringRule],
            'president_id' => 'nullable',
            'advisor_id' => ['required', 'exists:'. User::table(). ',id'],
            'participant_advisors' => [new PresidentIsChairman],
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
