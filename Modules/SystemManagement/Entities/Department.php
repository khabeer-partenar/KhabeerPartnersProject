<?php

namespace Modules\SystemManagement\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Committee\Entities\Committee;
use Modules\Committee\Entities\CommitteeDepartment;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\Coordinator;

class Department extends Model
{
    use SoftDeletes, \Modules\Core\Traits\SharedModel, \Modules\Core\Traits\Log;
    
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
    protected $fillable = ['parent_id', 'name', 'type', 'key', 'can_deleted', 'is_reference', 'reference_id', 'telephone', 'address', 'email', 'direct_manager_id', 'order'];

    /**
     * Functions
     *
     * Here you should add Functions
    */

    public static function boot() 
    {
        parent::boot();
        
        static::addGlobalScope('orderByorder', function (Builder $builder) {
            $builder->orderBy('order');
        });
        
        static::creating(function (Department $department) {
            $currentOrder = self::where('type', $department->type)->max('order');
            $department->order = $currentOrder + 1;
        });

    }

    /**
     * Get parent of dept
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Get childrens depts
     */
    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * Get attached users
     */
    public function users($key)
    {
        return $this->hasMany(User::class, $key . '_department_id', 'id');
    }

    /**
     * Get attached employees
     */
    public function employees($key)
    {
        return $this->hasMany(Employee::class, $key . '_department_id', 'id');
    }

    /**
     * Get attached coordinators
     */
    public function coordinators($key)
    {
        return $this->hasMany(Coordinator::class, $key . '_department_id', 'id');
    }

    public function getDepartmentDelegates($department_id)

    {
        // $this->delegates('direct')->where('direct_department_id',$department_id)->get();
    }

    public function delegates()
    {
        return $this->hasMany(Delegate::class, 'parent_department_id', 'id');
    }

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
        $staffsDepartments = self::staffsDepartments()->select('name', 'id')->get();
        $staffExpertsDepartments = self::staffExpertsDepartments($staffsDepartments[0]->id)->select('name', 'id')->get();
        $directDepartments = self::directDepartments($staffExpertsDepartments[0]->id)->select('name', 'id')->get();

        $staffsDepartments = $staffsDepartments->pluck('name', 'id');
        $staffExpertsDepartments = $staffExpertsDepartments->pluck('name', 'id');
        $directDepartments = $directDepartments->pluck('name', 'id')->prepend('', '');

        return ['staffsDepartments' => $staffsDepartments, 'staffExpertsDepartments' => $staffExpertsDepartments, 'directDepartments' => $directDepartments];
    }

    /**
     * Create new record in table
     */
    public static function createNewDepartment($data)
    {
        if (!isset($data['parent_id'])) {
            $data['parent_id'] = 0;
        }

        if (!isset($data['key'])) {
            $data['key'] = time();
        }

        if (!isset($data['is_reference'])) {
            $data['is_reference'] = 0;
        }

        if ($data['is_reference'] == 1) {
            $data['reference_id'] = null;
        }

        return self::create($data);
    }

    /**
     * Update department
     */
    public function updateDepartment($data)
    {
        if (!isset($data['direct_manager_id'])) {
            $data['direct_manager_id'] = null;
        }
        return $this->update($data);
    }

    /**
     *
     */
    public static function scopeGetDepartmentsData($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scopes
     * getting main coordinator main depaertments
     * Here you should add Scopes
     */
    public static function scopeGetDepartmentsWithRef($query, $parentId)
    {
        if (!$parentId) {
            abort(404);
        }
        $parentDepartment = self::findOrFail($parentId);
        if (auth()->user()->user_type == Coordinator::TYPE && $parentDepartment->type == self::mainDepartment) {
            $departmentsIds = self::query()
                ->where('reference_id', auth()->user()->parent_department_id)
                ->orWhere(function ($query) {
                    $query->where('id', auth()->user()->parent_department_id)->where('is_reference', true);
                })
                ->pluck('id');
        }
        if (isset($departmentsIds)) {
            $query->whereIn('id', $departmentsIds);
        }
        return
            $query
                ->select('id', 'name', 'reference_id', 'is_reference')
                ->where('parent_id', $parentId)
                ->with('referenceDepartment')
                ->get()->prepend(Department::getEmptyObjectForSelectAjax());
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
        if (auth()->user()->authorizedApps->key == Coordinator::MAIN_CO_JOB) {
            $mainDepartmentsIds = array();
            $coordinator = Coordinator::find(auth()->user()->id);
            array_push($mainDepartmentsIds, $coordinator->main_department_id);
            $childrenMainDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('parent_id')->toArray();
            $finalMainDepartmentsIds = array_merge($mainDepartmentsIds, $childrenMainDepartments);
            $mainDepartments = $query->whereIn('id', $finalMainDepartmentsIds);
            return $mainDepartments;
        } elseif (auth()->user()->authorizedApps->key == Coordinator::NORMAL_CO_JOB) {
            $coordinator = Coordinator::find(auth()->user()->id);
            $mainDepartments = $query->Where('id', $coordinator->main_department_id);
            return $mainDepartments;
        } else {
            return $query->where([
                ['type', 1],
                ['parent_id', 0]
            ]);
        }
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

    public static function scopeGetParentDepartmentsCo($query, $parentId)
    {
        $query->where(function ($query) {
            $query->where('reference_id', auth()->user()->parent_department_id)
                ->orWhere('id', auth()->user()->parent_department_id)->pluck('id');
        });
        return $query->parentDepartments($parentId)
            ->pluck('name', 'id');
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
        if ($parentID != 0) {
            $query = $query->parentDepartments($parentID);
        }

        return $query->where('key', 'staff_experts');
    }


    /**
     * Search scope
     */
    public static function scopeSearch($query, $request)
    {
        $department_id = (int)$request->department_id;
        $main_department_id = (int)$request->main_department_id;
        $parent_department_id = (int)$request->parent_department_id;

        if ($department_id) {
            $query->where('id', $department_id);
        }

        if ($main_department_id) {
            $query->where('parent_id', $main_department_id);
        }

        if ($parent_department_id) {
            $query->where('id', $parent_department_id);
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

    public function referenceDepartment()
    {
        return $this->belongsTo(self::class, 'reference_id', 'id');
    }

    public function referenceChildrenDepartments()
    {
        return $this->hasMany(self::class, 'reference_id', 'id');
    }

    /**
     * Get parent of dept
     */
    public function directManager()
    {
        return $this->hasOne(Employee::class, 'id', 'direct_manager_id');
    }

//    public function committeesPivot()
//    {
//        return $this->hasMany(CommitteeDepartment::class, 'department_id');
//    }

    public function committees()
    {
        return $this->belongsToMany(Committee::class, 'committees_participant_departments', 'department_id', 'committee_id')
            ->withTimestamps()
            ->withPivot('nomination_criteria');
    }
}
