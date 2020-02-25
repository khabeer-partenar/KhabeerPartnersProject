<?php

namespace Modules\Committee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;

class Religion extends Model
{
    use SharedModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'religions';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['type', 'name_en'];

    public function drivers()
    {
        return $this->hasMany(MeetingDriver::class, 'religion_id');
    }

}
