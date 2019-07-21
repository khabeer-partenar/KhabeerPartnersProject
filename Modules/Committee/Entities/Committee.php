<?php

namespace Modules\Committee\Entities;

use App\Classes\Date\CarbonHijri;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class Committee extends Model
{
    use SharedModel, Log;

    const WAITING_DELEGATES = 'waiting_for_delegates';
    const NOMINATIONS_COMPLETED = 'nominations_completed';
    const HOLD = 'hold';
    const WAITING_SIGNATURE = 'waiting_for_signature';
    const SIGNATURE_COMPLETED = 'signature_completed';

    protected $fillable = [
        'resource_staff_number', 'resource_at', 'resource_by', 'treatment_number', 'treatment_time', 'treatment_type_id',
        'treatment_urgency_id', 'treatment_importance_id', 'source_of_study_id', 'recommendation_number', 'recommended_by_id',
        'recommended_at', 'subject', 'first_meeting_at', 'tasks', 'president_id', 'advisor_id', 'members_count', 'status'
    ];

    protected $appends = [
        'resource_at_hijri', 'uuid', 'created_at_hijri', 'first_meeting_at_hijri', 'recommended_at_hijri'
    ];

    protected $dates = [
        'resource_at', 'treatment_time', 'first_meeting_at', 'recommended_at'
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

    public function setRecommendedAtAttribute($value)
    {
        $this->attributes['recommended_at'] = self::getDateFromFormat($value);
    }

    public function getResourceAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['resource_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getRecommendedAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['recommended_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getfirstMeetingAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['first_meeting_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getCreatedAtHijriAttribute()
    {
        $date = Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        return CarbonHijri::toHijriFromMiladi($date);
    }

    public function getUuidAttribute()
    {
        $hijriDate = Carbon::parse($this->created_at_hijri);
        return $hijriDate->year . '-' . $this->attributes['id'] ;
    }

    /**
     * Scopes
     *
     * Here Scopes
     */
    public function scopeSearch($query)
    {
        if(auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            $advisorsId = auth()->user()->advisors()->pluck('users.id');
            $query->whereIn('advisor_id', $advisorsId);
        } elseif (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            //
        }
        return $query;
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
        $committee = self::query()->create(
            array_merge(
                $request->all(),
                [
                    'status' => self::WAITING_DELEGATES,
                ]
            )
        );
        $committee->participantAdvisors()->attach($request->participant_advisors);
        $committee->participantDepartments()->sync($request->departments);
        $committee->update(['members_count' => $committee->participantDepartments()->count()]);
        CommitteeDocument::updateDocumentsCommittee($committee->id);
        return $committee;
    }

    /**
     * Relations
     *
     * Here goes relations
     */
    public function treatmentUrgency()
    {
        return $this->belongsTo(TreatmentUrgency::class, 'treatment_urgency_id');
    }

    public function treatmentType()
    {
        return $this->belongsTo(TreatmentType::class, 'treatment_type_id');
    }

    public function treatmentImportance()
    {
        return $this->belongsTo(TreatmentImportance::class, 'treatment_importance_id');
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }

    public function documents()
    {
        return $this->hasMany(CommitteeDocument::class, 'committee_id');
    }

    public function resourceDepartment()
    {
        return $this->belongsTo(Department::class, 'resource_by');
    }

    public function recommendedByDepartment()
    {
        return $this->belongsTo(Department::class, 'recommended_by_id');
    }

    public function participantAdvisors()
    {
        return $this->belongsToMany(User::class, 'committees_participant_advisors', 'committee_id', 'advisor_id')->withTimestamps();
    }

    public function participantDepartments()
    {
        return $this->belongsToMany(Department::class, 'committees_participant_departments', 'committee_id', 'department_id')->withTimestamps();
    }
}
