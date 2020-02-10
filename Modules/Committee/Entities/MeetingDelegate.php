<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Delegate;

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

    public static function updateStatusAndReason($status, $refuse_reason, $meeting, $has_diver, $driver_id)
    {
        if ($status == MeetingDelegate::ACCEPTED) $refuse_reason = null;

        self::where('meeting_id', $meeting->id)
            ->where('delegate_id', auth()->id())
            
            ->update(array('status' => $status, 'refuse_reason' => $refuse_reason, 'has_driver' => $has_diver, 'driver_id' => $driver_id));
    }

    public function drivers()
    {
        $this->hasMany(MeetingDriver::class);
    }
}
