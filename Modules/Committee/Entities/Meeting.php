<?php

namespace Modules\Committee\Entities;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class Meeting extends Model
{
    use SharedModel, SoftDeletes, Log;

    protected $fillable = [
        'from', 'to', 'type_id', 'room_id', 'attendance_done',
        'committee_id', 'reason', 'description', 'completed', 'advisor_id'
    ];
    protected $appends = ['meeting_at', 'meeting_at_ar', 'from_date', 'to_date', 'is_old'];

    /**
     * Scopes
     */
    public function scopeFilterByUser($query, Committee $committee)
    {
        if (auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            $query->whereIn('completed', [0, 1]);
        } elseif (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            if ($committee->advisor_id == auth()->id()) {
                $query->whereIn('completed', [0, 1]);
            } else {
                $allowedMeetingIds = MeetingAdvisor::where('advisor_id', auth()->id())->pluck('meeting_id');
                $query->whereIn('id', $allowedMeetingIds)->where('completed', 1);
            }
        } elseif (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) { // add further conditions if there are
            $query->where('completed', 1);
        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) { // add further conditions if there are
            $query->where('completed', 1);
        } elseif (auth()->user()->authorizedApps->key == Delegate::JOB) {
            $allowedMeetingIds = MeetingDelegate::where('delegate_id', auth()->id())->pluck('meeting_id');
            $query->whereIn('id', $allowedMeetingIds)->where('completed', 1);
        }
    }

    public function scopeFilterAllByUser($query)
    {
        if (auth()->user()->authorizedApps->key == Employee::SECRETARY) {
            $advisorsId = auth()->user()->advisors()->pluck('users.id');
            $query->whereIn('advisor_id', $advisorsId);
        } elseif (auth()->user()->authorizedApps->key == Employee::ADVISOR) {
            $allowedMeetingIds = MeetingAdvisor::where('advisor_id', auth()->id())->pluck('meeting_id');
            $query
                ->whereIn('id', $allowedMeetingIds)
                ->orWhere(function ($query) {
                    $query->where('advisor_id', auth()->id());
                });
        } elseif (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {

        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {

        } elseif (auth()->user()->authorizedApps->key == Delegate::JOB) {
            $allowedMeetingIds = MeetingDelegate::where('delegate_id', auth()->id())->pluck('meeting_id');
            $query->whereIn('id', $allowedMeetingIds);
        }
        return $query->where('completed', 1);
    }

    public function scopeCalendar($query, $data = [])
    {
        if (isset($data['from']) && isset($data['to'])) {
            try {
                $fromDate = Carbon::parse($data['from']);
                $toDate = Carbon::parse($data['to']);
            } catch (InvalidDateException $exception) {
                throw new $exception;
            }
        } else { // Default is this month
            $fromDate = Carbon::now()->startOfMonth();
            $toDate = Carbon::now()->endOfMonth();
        }
        $query->whereBetween('from', [$fromDate, $toDate]);
    }

    /**
     * Accs & Mut
     */
    public function getFromAttribute()
    {
        return Carbon::parse($this->attributes['from'])->format('H:i');
    }

    public function getToAttribute()
    {
        return Carbon::parse($this->attributes['to'])->format('H:i');
    }

    public function getFromDateAttribute()
    {
        return Carbon::parse($this->attributes['from'])->format('Y-m-d H:i:s');
    }

    public function getToDateAttribute()
    {
        return Carbon::parse($this->attributes['to'])->format('Y-m-d H:i:s');
    }

    public function getMeetingAtAttribute()
    {
        return Carbon::parse($this->attributes['from'])->format('d-m-Y');
    }

    public function getMeetingAtArAttribute()
    {
        $date = Carbon::parse($this->attributes['from']);
        return $date->format('d') . ' '. trans('months.en_' . $date->format('F')) . ' ' . $date->format('Y');
    }

    public function getCanChangeMembersAttribute()
    {
        return Carbon::parse($this->meeting_at)->gt(Carbon::today());
    }

    public function getIsOldAttribute()
    {
        return Carbon::parse($this->meeting_at)->lte(Carbon::today());
    }

    public function setFromAttribute($value)
    {
        try {
            $dateArr = explode(',', $value);
            if (isset($dateArr[0]) && isset($dateArr[1])) {
                $day = Carbon::createFromFormat('m/d/Y', $dateArr[1])->startOfDay();
                $to = Carbon::parse($dateArr[0])->diffInSeconds(Carbon::today());
                $this->attributes['from'] = $day->addSeconds($to);
            } else {
                $this->attributes['from'] = Carbon::parse($value);
            }
        } catch (InvalidDateException $exception) {
            throw new $exception;
        }
    }

    public function setToAttribute($value)
    {
        try {
            $dateArr = explode(',', $value);
            if (isset($dateArr[0]) && isset($dateArr[1])) {
                $day = Carbon::createFromFormat('m/d/Y', $dateArr[1])->startOfDay();
                $to = Carbon::parse($dateArr[0])->diffInSeconds(Carbon::today());
                $this->attributes['to'] = $day->addSeconds($to);
            } else {
                $this->attributes['to'] = Carbon::parse($value);
            }
        } catch (InvalidDateException $exception) {
            throw new $exception;
        }
    }

    /**
     * Functions
     */
    public static function createFromRequest($request, Committee $committee)
    {
        $meeting = Meeting::create(array_merge([
            'from' => $request->from.','.$request->at,
            'to' => $request->to.','.$request->at,
            'committee_id' => $committee->id,
            'completed' => true,
            'advisor_id' => $committee->advisor_id
        ], $request->only(['type_id', 'room_id', 'reason', 'description'])));

        $meeting->delegates()->sync($request->delegates);
        $meeting->participantAdvisors()->sync($request->participantAdvisors);

        MeetingDocument::updateDocumentsMeeting($meeting->id, $committee->id);

        return $meeting;
    }

    public function updateFromRequest($request)
    {
        $this->update(array_merge([
            'from' => $request->from.','.$request->at,
            'to' => $request->to.','.$request->at,
            'completed' => true
        ], $request->only(['type_id', 'room_id', 'reason', 'description'])));

        if ($this->can_change_members) {
            $this->delegates()->sync($request->delegates ? $request->delegates : []);
            $this->participantAdvisors()->sync($request->participantAdvisors ? $request->participantAdvisors : []);
        }

        return $this;
    }

    public function attend($data)
    {
        if (isset($data['delegates']) && is_array($data['delegates'])){
            foreach ($this->delegatesPivot as $delegatePivot) {
                if (in_array($delegatePivot->delegate_id, $data['delegates'])) {
                    $delegatePivot->update(['attended' => 1, 'attendance_taker_id' => auth()->id()]);
                }
            }
        }
        if (isset($data['participantAdvisors']) && is_array($data['participantAdvisors'])) {
            foreach ($this->participantAdvisorsPivot as $participantAdvisor) {
                if (in_array($participantAdvisor->advisor_id, $data['participantAdvisors'])) {
                    $participantAdvisor->update(['attended' => 1, 'attendance_taker_id' => auth()->id()]);
                }
            }
        }
        $this->update(['attendance_done' => 1]);
    }

    /**
     * Relations
     */
    public function delegates()
    {
        return $this->belongsToMany(Delegate::class, MeetingDelegate::table(), 'meeting_id', 'delegate_id')
            ->withPivot('refuse_reason', 'status', 'attended');
    }

    public function delegatesPivot()
    {
        return $this->hasMany(MeetingDelegate::class, 'meeting_id');
    }

    public function attendingDelegates()
    {
        return $this->hasMany(MeetingDelegate::class, 'meeting_id')->where('status', MeetingDelegate::ACCEPTED);
    }

    public function absentDelegates()
    {
        return $this->hasMany(MeetingDelegate::class, 'meeting_id')->where('status', MeetingDelegate::REJECTED);
    }

    public function type()
    {
        return $this->belongsTo(MeetingType::class);
    }

    public function room()
    {
        return $this->belongsTo(MeetingRoom::class);
    }

    public function participantAdvisors()
    {
        return $this->belongsToMany(Employee::class, MeetingAdvisor::table(), 'meeting_id', 'advisor_id')
            ->withPivot('attended', 'status');
    }

    public function participantAdvisorsPivot()
    {
        return $this->hasMany(MeetingAdvisor::class, 'meeting_id');
    }

    public function attendingAdvisors()
    {
        return $this->hasMany(MeetingAdvisor::class, 'meeting_id')->where('status', MeetingAdvisor::ACCEPTED);
    }

    public function absentAdvisors()
    {
        return $this->hasMany(MeetingAdvisor::class, 'meeting_id')->where('status', MeetingAdvisor::REJECTED);
    }

    public function documents()
    {
        return $this->hasMany(MeetingDocument::class);
    }

    public function multimedia()
    {
        return $this->hasMany(MeetingMultimedia::class);
    }

    public function userMultimedia()
    {
        return $this->multimedia()->where('user_id',auth()->user()->id)->orderBy('updated_at', 'asc');
    }

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }
}
