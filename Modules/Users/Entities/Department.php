<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Modules\Core\Traits\SharedModel;

    const mainDepartment = 1;
    const parentDepartment = 2;
    const directDepartment = 3;

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
     * Scopes
     *
     * Here you should add Scopes
     */
    public static function scopeGetDepartmentsWithRef($query, $parentId)
    {
        if (!$parentId) {
            abort(404);
        }
        $parentDepartment = self::findOrFail($parentId);
        if (auth()->user()->user_type == Coordinator::TYPE && $parentDepartment->type == self::mainDepartment) {
            $query->where('reference_id', auth()->user()->department_reference_id);
        }
        return
            $query
                ->with('referenceDepartment')
                ->where('parent_id', $parentId)->get(['id', 'name', 'reference_id'])->prepend(Department::getEmptyObjectForSelectAjax());
    }

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
     * Relations
     *
     * Here you should add Relations
     */
    public function parentDepartment()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function referenceDepartment()
    {
        return $this->belongsTo(self::class, 'reference_id', 'id');
    }
}
