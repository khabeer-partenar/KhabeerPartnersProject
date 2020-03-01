<?php

namespace Modules\Committee\Entities;
use Modules\Committee\Entities\Religion;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Modules\Committee\Entities\MeetingDelegate;
use Modules\Committee\Entities\Nationality;


class MeetingDriver extends Model
{
    use SharedModel;

    protected $table = 'delegate_driver';

    protected $fillable = ['name', 'national_id', 'nationality_id', 'religion_id', 'delegate_id', 'nationality'];

   /**
     * Scopes
     *
     * Here add Scopes
     * @param $query
     * @param Request $request
     */
    public function scopeSearchDriver($query, $request)
    {
        if((int)$request->id && $request->id > 0) {
            $query->where('id', $request->id);
        }

        if((int)$request->name && $request->name > 0) {
            $query->where('name', $request->name);
        }

        
        return $query;
    }


    public static function createFromRequest($request)
    {
        $driver = MeetingDriver::create([
            'name' => $request->name,
            'delegate_id' => auth()->id(),
            'national_id' => $request->national_id,
            'nationality_id' => $request->nationality_id,
            'religion_id' => $request->religion_id,
        ]);
        return $driver;
        
    }
   
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }


    public function meetingDelegate()
    {
        return $this->belongsTo(MeetingDelegate::class, 'driver_id');
    }

}