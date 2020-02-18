<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Delegate;
use Modules\Committee\Notifications\MeetingDelegatesInviting;
use Modules\Committee\Notifications\MeetingDelegatesRemoved;
use Notification;


class MeetingDelegate extends Model
{
    use SharedModel;

    protected $table = 'meetings_delegates';
    protected $fillable = ['status', 'attended', 'attendance_taker_id'];

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

    // Functions
    public static function prepareForSync($delegatesIds = [], $old_delegates=null, $meeting)
    {
        $delegates = Delegate::whereIn('id', $delegatesIds);
        $removed_delegates = Delegate::whereIn('id', array_diff($old_delegates->pluck('id')->toArray(), $delegates->pluck('id')->toArray()));
        $new_delegates = Delegate::whereIn('id', array_diff($delegates->pluck('id')->toArray(), $old_delegates->pluck('id')->toArray()));
        if($removed_delegates->count())
            Notification::send($removed_delegates->get(), new MeetingDelegatesRemoved($meeting->committee,$meeting));
        if($new_delegates->count())
            Notification::send($new_delegates->get(), new MeetingDelegatesInviting($meeting->committee,$meeting));

        $prepared = [];
        foreach ($delegates->pluck('parent_department_id', 'id') as $key => $department){
            $prepared[$key] = [
                'department_id' => $department
            ];
        }
        return $prepared;
    }

    public static function updateStatusAndReason($status, $refuse_reason, $meeting)
    {
        if ($status == MeetingDelegate::ACCEPTED) $refuse_reason = null;

        self::where('meeting_id', $meeting->id)
            ->where('delegate_id', auth()->id())
            ->update(array('status' => $status, 'refuse_reason' => $refuse_reason));
    }
}
