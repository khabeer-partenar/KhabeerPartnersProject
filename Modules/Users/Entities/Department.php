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
     * Functions
     *
     * Here you should add Functions
     */
    public static function scopeGetParentDepartments($query, $parentId)
    {
        return $query->parentDepartments($parentId)->pluck('name', 'id');
    }

    public static function scopeGetDirectDepartments($query, $parentId)
    {
        return $query->directDepartments($parentId)->pluck('name', 'id');
    }

    public static function getEmptyObjectForSelectAjax()
    {
        return (['id' => '', 'name' => __('users::departments.choose a department')]);
    }

    public static function getEmptyObjectForSelect()
    {
        return (__('users::departments.choose a department'));
    }

    /**
     * Scopes
     *
     * Here you should add Scopes
     */

    public static function scopeGetDepartments($query)
    {
        return $query->mainDepartments($query)->pluck('name', 'id')->toArray();
    }

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


    /**
     * Get staffs depts
     */
    public static function scopeStaffsDepartments($query)
    {
        return $query->mainDepartments($query)->where('key', 'staff');
    }

    /**
     * Get staff experts depts
     */
    public static function scopeStaffExpertsDepartments($query, $parentID = 0)
    {
        if($parentID != 0) {
            $query = $query->parentDepartments($parentID);
        }
        
        return $query->where('key', 'staff_experts');
    }
}
