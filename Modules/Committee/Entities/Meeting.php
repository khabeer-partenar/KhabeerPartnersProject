<?php

namespace Modules\Committee\Entities;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Log;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class Meeting extends Model
{
    use SharedModel, SoftDeletes, Log;

    protected $fillable = ['from', 'to', 'type_id', 'room_id', 'committee_id', 'reason', 'description'];
    protected $appends = ['meeting_at', 'meeting_at_ar'];

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

    public function getMeetingAtAttribute()
    {
        return Carbon::parse($this->attributes['from'])->format('d-m-Y');
    }

    public function getMeetingAtArAttribute()
    {
        $date = Carbon::parse($this->attributes['from']);
        return $date->format('d') . ' '. trans('months.en_' . $date->format('F')) . ' ' . $date->format('Y');
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
            'committee_id' => $committee->id
        ], $request->only(['type_id', 'room_id', 'reason', 'description'])));

        $meeting->delegates()->sync($request->delegates);

        $meeting->participantAdvisors()->sync($request->participantAdvisors);

        MeetingDocument::updateDocumentsMeeting($meeting->id, $committee->id);

        return $meeting;
    }

    public function updateFromRequest($request, Committee $committee)
    {
        $this->update(array_merge([
            'from' => $request->from.','.$request->at,
            'to' => $request->to.','.$request->at,
            'committee_id' => $committee->id
        ], $request->only(['type_id', 'room_id', 'reason', 'description'])));

        $this->delegates()->sync($request->delegates ? $request->delegates:[]);

        $this->participantAdvisors()->sync($request->participantAdvisors ? $request->participantAdvisors:[]);

        return $this;
    }

    /**
     * Relations
     */
    public function delegates()
    {
        return $this->belongsToMany(Delegate::class, MeetingDelegate::table(), 'meeting_id', 'delegate_id')
            ->withPivot('refuse_reason', 'status');
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
        return $this->belongsToMany(Employee::class, MeetingAdvisor::table(), 'meeting_id', 'advisor_id');
    }

    public function documents()
    {
        return $this->hasMany(MeetingDocument::class);
    }

    public function multimedia()
    {
        return $this->hasMany(MeetingMultimedia::class)
            ->where('user_id',auth()->user()->id)
            ->orderBy('updated_at', 'asc');

    }
}
