<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\Delegate;
use Modules\Committee\Notifications\MeetingDelegatesInviting;
use Modules\Committee\Notifications\MeetingDelegatesRemoved;
use Notification;


class MeetingDelegate extends Model
{
    use SharedModel;

    protected $table = 'meetings_delegates';
    protected $fillable = [
        'status', 'attended', 'attendance_taker_id', 'driver_id', 'has_driver', 'refuse_reason',
        'department_id', 'delegate_id', 'meeting_id'
    ];

    const INVITED = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;
    const STATUS = [
        0 => 'invited',
        1 => 'accepted',
        2 => 'rejected',
    ];
    const attendingStatus = [
        0 => 'no',
        1 => 'yes'
    ];

    // Accs & Mutators
    public function setRefuseReasonAttribute($value)
    {
        $this->attributes['refuse_reason'] = $this->attributes['status'] == self::ACCEPTED ? null:$value;
    }

    public function setDriverIdAttribute($value)
    {
        $this->attributes['driver_id'] = $this->attributes['has_driver'] == 0 ? null:$value;
    }

    // Functions
    public static function prepareForSync($delegatesIds = [])
    {
        $delegates = Delegate::whereIn('id', $delegatesIds)->pluck('parent_department_id', 'id');

        $prepared = [];
        foreach ($delegates as $key => $department){
            $prepared[$key] = [
                'department_id' => $department
            ];
        }
        return $prepared;
    }

    public static function MeetingCreateDelegatesNotifications($delegatesIds = [], $meeting)
    {
        if($delegatesIds)
        {
            $new_delegates = Delegate::whereIn('id', $delegatesIds);
            if($new_delegates->count())
                Notification::send($new_delegates->get(), new MeetingDelegatesInviting($meeting->committee,$meeting));
        }
        
    }

    public static function MeetingUpdateDelegatesNotifications($delegatesIds = [], $old_delegates = [], $meeting)
    {
            if($delegatesIds)
            {
                $delegates = Delegate::whereIn('id', $delegatesIds);
                $removed_delegates = Delegate::whereIn('id', array_diff($old_delegates->pluck('id')->toArray(), $delegates->pluck('id')->toArray()));
                $new_delegates = Delegate::whereIn('id', array_diff($delegates->pluck('id')->toArray(), $old_delegates->pluck('id')->toArray()));
                if($removed_delegates->count())
                    Notification::send($removed_delegates->get(), new MeetingDelegatesRemoved($meeting->committee,$meeting));
                if($new_delegates->count())
                    Notification::send($new_delegates->get(), new MeetingDelegatesInviting($meeting->committee,$meeting));
            }
            else
            {
                $removed_delegates = Delegate::whereIn('id', $old_delegates->pluck('id')->toArray());
                if($removed_delegates->count())
                    Notification::send($removed_delegates->get(), new MeetingDelegatesRemoved($meeting->committee,$meeting));
            }
    }

    public function driver()
    {
        return $this->belongsTo(MeetingDriver::class, 'driver_id', 'id')->with('religion');
    }
}
