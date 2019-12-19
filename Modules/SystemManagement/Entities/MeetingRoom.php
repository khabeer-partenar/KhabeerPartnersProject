<?php

namespace Modules\SystemManagement\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Entities\City;

class MeetingRoom extends Model
{
    use SoftDeletes, \Modules\Core\Traits\SharedModel, \Modules\Core\Traits\Log;


    const STATUS = [
        'choose'  => '',
        'inactive' => 0,
        'active' => 1,
    ];

    const STATUS_TEXT = [
        self::STATUS['choose']  => 'أختر',
        self::STATUS['inactive'] => 'لا تعمل',
        self::STATUS['active'] => 'تعمل',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meetings_rooms';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'city_id', 'capacity', 'status'
    ];


    protected $appends = ['status_text'];
    /**
     * scopes
     * 
     * Here you should add scopes
     */


    /**
     * Search scope
     */
    public static function scopeSearch($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ((int)$request->city_id) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->status != null && in_array($request->status, [self::STATUS['active'], self::STATUS['inactive']])) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    /**
     * Functions
     *
     * Here you should add Functions
    */
    public function getStatusTextAttribute()
    {
        return self::STATUS_TEXT[$this->status];
    }


    /**
     * Create new record in table
     */
    public static function createFormRequest($request)
    {
        return self::create($request->all());
    }

    /**
     * Update department
     */
    public function updateFormRequest($request)
    {
        return $this->update($request->all());
    }

    /**
     * Relations
     *
     * Here goes relations
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
