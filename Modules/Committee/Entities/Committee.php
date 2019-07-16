<?php

namespace Modules\Committee\Entities;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\User;

class Committee extends Model
{
    use SharedModel, Log;

    protected $fillable = [
        'resource_staff_number', 'resource_at', 'resource_by', 'treatment_number', 'treatment_time', 'treatment_type_id',
        'treatment_urgency_id', 'treatment_importance_id', 'source_of_study_id', 'recommendation_number', 'recommended_by_id',
        'recommended_at', 'subject', 'first_meeting_at', 'tasks', 'president_id', 'advisor_id', 'members_count'
    ];

    /**
     * Accessors and Mutators
     *
     * Here goes Acc. and Mut.
     */
    public function setResourceAtAttribute($value)
    {
        $this->attributes['resource_at'] = self::getDateFromFormat($value);
    }

    public function setTreatmentTimeAttribute($value)
    {
        $this->attributes['treatment_time'] = self::getDateFromFormat($value);
    }

    public function setFirstMeetingAtAttribute($value)
    {
        $this->attributes['first_meeting_at'] = self::getDateFromFormat($value);
    }

    /**
     * Scopes
     *
     * Here Scopes
     */
    public function scopeSearch($query)
    {
        //
    }

    /**
     * Functions
     *
     * Here goes functions
     */

    public static function getDateFromFormat($value, $format = 'm/d/Y') {
        try {
            return $date = Carbon::createFromFormat($format, $value);
        } catch (InvalidDateException $exception) {
            report($exception);
            return false;
        }
    }

    public static function createFromRequest($request)
    {
        $committee = self::query()->create($request->all());
        $committee->participantAdvisors()->attach($request->participant_advisors);
        $committee->participantDepartments()->sync($request->departments);
        return $committee;
    }

    /**
     * Relations
     *
     * Here goes relations
     */
    public function participantAdvisors()
    {
        return $this->belongsToMany(User::class, 'committees_participant_advisors', 'committee_id', 'advisor_id');
    }

    public function participantDepartments()
    {
        return $this->belongsToMany(Department::class, 'committees_participant_departments', 'committee_id', 'department_id');
    }
}
