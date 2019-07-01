<?php

namespace Modules\SystemManagement\Entities;

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
    protected $fillable = ['parent_id', 'name', 'type', 'key', 'is_reference', 'reference_id'];

    /**
     * departments types
     *
     * @var array
     */
    public static $departmentsTypes = [
        'parent' => 1,
    ];

    /**
     * Functions
     *
     * Here you should add Functions
     */
    public static function getEmptyObjectForSelectAjax()
    {
        return (['id' => '', 'name' => __('users::departments.choose a department')]);
    }

    public static function getEmptyObjectForSelect()
    {
        return (__('users::departments.choose a department'));
    }

    public function getDepartmentObjectForSelect()
    {
        return [@$this->id => @$this->name];
    }
    /**
     * Get Departments data for users forms
     */

    public static function getDepartmentsDataForUsersForms()
    {
        $staffsDepartments       = self::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartments = self::staffExpertsDepartments($staffsDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments       = self::directDepartments($staffExpertsDepartments[0]->id)->select('name', 'id')->get();

        $staffsDepartments       = $staffsDepartments->pluck('name', 'id');
        $staffExpertsDepartments = $staffExpertsDepartments->pluck('name', 'id');
        $directDepartments       = $directDepartments->pluck('name', 'id')->prepend('', '');

        return ['staffsDepartments' => $staffsDepartments, 'staffExpertsDepartments' => $staffExpertsDepartments, 'directDepartments' => $directDepartments];
    }


    /**
     *  Select2 ajax search
     */
    public static function ajaxSearch($type, $searchValue)
    {
        if( !isset(self::$departmentsTypes[$type]) ) {
            return [];
        }

        $typeId = self::$departmentsTypes[$type];
        return self::where([ ['type', $typeId], ['name', 'LIKE', '%'. $searchValue .'%']])->select('id', 'name as text')->get();
    }

    /**
     * Create new record in table
     */
    public static function createNewDepartment($data) 
    {
        if(!isset($data['parent_id'])) {
            $data['parent_id'] = 0;
        }

        if(!isset($data['key'])) {
            $data['key'] = time();
        }

        return self::create($data);
    }

    /**
     * 
     */
    public static function scopeGetDepartmentsData($query, $type)
    {
        return $query->where('type', self::$departmentsTypes[$type]);
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
            ['type', 2],
            ['parent_id', $parentID]
        ]);
    }

    /**
     * Get direct depts  that are under another dept where type equal to 2 
     */
    public static function scopeDirectDepartments($query, $parentID)
    {
        return $query->where([
            ['type', 3],
            ['parent_id', $parentID]
        ]);
    }

    public static function scopeGetParentDepartments($query, $parentId)
    {
        return $query->parentDepartments($parentId)->pluck('name', 'id');
    }

    public static function scopeGetDirectDepartments($query, $parentId)
    {
        return $query->directDepartments($parentId)->pluck('name', 'id');
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


    /**
     * Search scope
     */
    public static function scopeSearch($query, $request)
    {
        if((int)$request->parent_department_id && $request->parent_department_id > 0) {
            $query->where('id', $request->parent_department_id);
        }
        return $query;
    }

    /**
     * Relations
     *
     * Here you should add Relations
     */
    public function parentDepartment()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
