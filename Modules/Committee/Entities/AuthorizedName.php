<?php

namespace Modules\Committee\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;
use Modules\SystemManagement\Entities\MeetingRoom;
use Modules\Committee\Entities\Religion;

class AuthorizedName extends Model
{
    protected $fillable = [];


    /**
     * The attributes that should be date to native types.
     *
     * @var array
     */
    protected $dates = [
        
        'from' ,
    ];

    const TYPE_TEXT = [
        'delegate' => 'مندوب ',
        'driver' => 'سائق'
    ];

    public function scopeSearch($query, $filters)
    {
        $query = DB::table('meetings_delegates')
            ->join('meetings', 'meetings.id', '=', 'meetings_delegates.meeting_id')
            ->join('users', 'users.id', '=', 'meetings_delegates.delegate_id')
            ->join('nationalities as delegate_nationality', 'delegate_nationality.id', '=', 'users.nationality_id')
            ->join('meetings_rooms', 'meetings_rooms.id', '=', 'meetings.room_id')
            ->join('users as advisors', 'advisors.id', '=', 'meetings.advisor_id')
            ->leftJoin('delegate_driver', 'meetings_delegates.driver_id', '=', 'delegate_driver.id')
            ->leftJoin('nationalities as driver_nationality', 'driver_nationality.id', '=', 'delegate_driver.nationality_id')
            ->leftJoin('religions', 'religions.id', '=', 'delegate_driver.religion_id')
            ->leftJoin('departments', 'departments.id', '=', 'users.parent_department_id')
            ->select('delegate_driver.name as driver_name', 'delegate_driver.national_id as driver_national_id',
                'religions.name as type', 'delegate_nationality.name as delegate_nationality_name', 'meetings_delegates.updated_at',
                'meetings_delegates.has_driver',
                'delegate_driver.id as driver_id', 'meetings.from',
                'driver_nationality.name as driver_nationality_name', 'users.national_id as delegate_national_id',
                'users.name as delegate_name', 'meetings.completed', 'meetings.advisor_id', 'meetings.room_id',
                'advisors.name as advisor_name', 'meetings_rooms.name as room_name', 'users.parent_department_id',
                'users.nationality_id', 'delegate_driver.delegate_id', 'departments.name as delegate_department_name')
            ->where('completed', 1);

        if(isset($filters['authorized_name'])) {
            $name = $filters['authorized_name'];
            $query->where('delegate_driver.name',  $name)->orWhere(function ($query) use ($name) {
                $query->where('users.name', 'LIKE', $name);
            });
        }
        if (isset($filters['advisor_id']) && $filters['advisor_id'] != 0) {
            $query->where('meetings.advisor_id', $filters['advisor_id']);
        }
        if (isset($filters['entry_time']) && $filters['entry_time'] != '') {
            $query->whereDate('meetings.from', $filters['entry_time']);
        } else {
            $query->whereDate('meetings.from', Carbon::today());
        }
        if(isset($filters['authorized_national_id'])) {
            $nationalId = $filters['authorized_national_id'];
            $query->where('delegate_driver.national_id', $nationalId )->orWhere(function ($query) use ($nationalId){
                $query->where('users.national_id', $nationalId)
                ->selectRaw("
                    CASE 
                   `khabeer_delegate_driver`.`national_id`
                    WHEN '$nationalId' THEN 'driver'
                    ELSE 'delegate'
                    END as user_type"
                );
            });
        }

        return $query;
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function room()
    {
        return $this->belongsTo(MeetingRoom::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }


}
