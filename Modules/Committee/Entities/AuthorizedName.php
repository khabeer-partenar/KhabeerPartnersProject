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

    const TYPE = [
        'delegate' => 'مندوب',
        'driver' => 'سائق',
    ];

    const TYPE_TEXT = [
        self::TYPE['delegate'] => 'مندوب ',
        self::TYPE['driver'] => 'سائق',
    ];

    public function scopeSearch($query, $filters)
    {
        $query = DB::table('meetings_delegates')
            ->join('delegate_driver', 'meetings_delegates.driver_id', '=', 'delegate_driver.id')
            ->Join('nationalities as driver_nationality', 'driver_nationality.id', '=', 'delegate_driver.nationality_id')
            ->join('meetings', 'meetings.id', '=', 'meetings_delegates.meeting_id')
            ->join('users', 'users.id', '=', 'meetings_delegates.delegate_id')            
            ->join('nationalities as delegate_nationality', 'delegate_nationality.id', '=', 'users.nationality_id')
            ->join('religions', 'religions.id', '=', 'delegate_driver.religion_id')
            ->select('delegate_driver.name as driver_name', 'delegate_driver.national_id as driver_national_id',
            'religions.name as type', 'delegate_nationality.name as delegate_nationality_name', 'meetings_delegates.updated_at',
            'meetings_delegates.has_driver',
            'delegate_driver.id as driver_id', 'meetings.from', 
            'driver_nationality.name as driver_nationality_name', 'users.national_id as delegate_national_id',
            'users.name as delegate_name',
            'users.nationality_id', 'delegate_driver.delegate_id')->whereDate('meetings_delegates.updated_at', Carbon::today());

            // $query->today();

            if(isset($filters['authorized_name'])) {
                $name = $filters['authorized_name'];
                $query->where('delegate_driver.name',  $name)
                ->orWhere('users.name', 'LIKE', $name );
            }
            if(isset($filters['authorized_national_id'])) {
                $national_id = $filters['authorized_national_id'];
                $query->where('delegate_driver.national_id', $national_id )
                ->orWhere('users.national_id', $national_id);
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
