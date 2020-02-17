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
    protected $fillable = ['status', 'attended', 'attendance_taker_id', 'driver_id', 'has_driver', 'refuse_reason'];

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

    public function driver()
    {
        return $this->belongsTo(MeetingDriver::class, 'driver_id', 'id')->with('religion');
    }
}
