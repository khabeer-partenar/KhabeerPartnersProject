<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Modules\Core\Traits\SharedModel;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'name', 'type'];


    /**
     * Get main departments where parent id equal to 0 and type equal to 1
     */
    public static function scopeMainDepartments($query)
    {
        return $query->where([
            ['type', 1],
            ['parent_id', 0]
        ]);
    }

    /**
     * Get departments that are under another dept where type equal to 1
     */
    public static function scopeParentDepartments($query, $parentID)
    {
        return $query->where([
            ['type', 1],
            ['parent_id', $parentID]
        ]);
    }

    /**
     * Get direct depts  that are under another dept where type equal to 2 
     */
    public static function scopeDirectDepartments($query, $parentID)
    {
        return $query->where([
            ['type', 2],
            ['parent_id', $parentID]
        ]);
    }
}
