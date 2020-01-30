<?php

namespace Modules\Committee\Entities;
use Modules\Committee\Entities\Religion;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class MeetingDriver extends Model
{
    use SharedModel;
    // use SharedModel, SoftDeletes;
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
            'nationality' => $request->nationality,
            'religion_id' => $request->input('religion_id'),
        ]);
        return $driver;
        
    }
   
    public function religiones()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function nationalities()
    {
        return $this->belongsTo(Nationality::class);
    }


}