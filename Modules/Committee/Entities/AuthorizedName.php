<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
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
        
        'entry_time' ,
    ];

    const TYPE = [
        'delegate' => 'مندوب',
        'driver' => 'سائق',
    ];

    const TYPE_TEXT = [
        self::TYPE['delegate'] => 'مندوب ',
        self::TYPE['driver'] => 'سائق',
    ];


    public static function scopeSearch($query, Array $filters)
    {

        if(isset($filters['job']))
        {
            $query->where('job', 'LIKE', '%' . $filters['job'] . '%');
        }
        if(isset($filters['name']))
         {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }
        if((int)isset($filters['national_id']))
         {
            $query->where('national_id', 'LIKE', '%' . $filters['national_id'] . '%');
        }
        

        return $query;
    }

    //releations

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
}
