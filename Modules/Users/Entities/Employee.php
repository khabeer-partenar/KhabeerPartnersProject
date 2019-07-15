<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Modules\Core\Entities\Group;

class Employee extends User
{
    /**
     * add global scope
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('filterUserType', function (Builder $builder) {
            $builder->where('user_type', 'user');
        });
    }
 

    /**
     * Get Departments data for forms
     */
    public function getDepartmentsDataForForms()
    {
        $staffsDepartments       = $this->directDepartment->parentDepartment->parentDepartment->getDepartmentObjectForSelect();
        $staffExpertsDepartments = $this->directDepartment->parentDepartment->getDepartmentObjectForSelect();
        $directDepartments       = $this->directDepartment->getDepartmentObjectForSelect();

        return ['staffsDepartments' => $staffsDepartments, 'staffExpertsDepartments' => $staffExpertsDepartments, 'directDepartments' => $directDepartments];
    }
    
    /**
     * Create new User
     */
    public static function createNewEmployee($request)
    {
        $userData = self::create($request->only('direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_role_id'));
        $userData->groups()->attach($request->job_role_id);
        return $userData;
    }

    /**
     * Update current user
     */
    public function updateEmployee($request)
    {
        if($this->job_role_id != $request->job_role_id) {
            // detach user
            $this->groups()->detach($this->job_role_id);
            $this->groups()->attach($request->job_role_id);
        }

        $userData  = $this->update($request->only('direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_role_id'));
        return $userData;
    }

    /**
     * Sync Secretaries Users
     */
    public function syncSecretariesEmployees($secretariesIds)
    {
        $secretariesIds  = !is_array($secretariesIds) ? [] : $secretariesIds;
        $secretariesData = [];

        foreach($secretariesIds as $secretaryID) {
            $secretaryData = self::where('id', $secretaryID)->first();

            if(!$secretaryData || !$secretaryData->hasSecretariesGroup()) {
                continue;
            }

            $secretariesData[] = [
                'advisor_user_id' => $this->id,
                'secretary_user_id' => (int)$secretaryID,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        
        $this->secretaries()->delete();

        if(!empty($secretariesData)) {
            $this->secretaries()->insert($secretariesData);
        }
    }

    public static function studyChairman()
    {
        $groupsIds = Group::whereIn('key', ['chairman_of_the_commission', 'vice_chairman_of_the_commission'])->pluck('id');
        return self::whereIn('job_role_id', $groupsIds)->get();
    }

    /**
     * Scopes
     *
     * Here add Scopes
     * @param $query
     * @param Request $request
     */
    public static function scopeSearch($query, $request)
    {
        if((int)$request->employee_id && $request->employee_id > 0) {
            $query->where('id', $request->employee_id);
        }

        if((int)$request->job_role_id && $request->job_role_id > 0) {
            $query->where('job_role_id', $request->job_role_id);
        }

        if((int)$request->direct_department_id && $request->direct_department_id > 0) {
            $query->where('direct_department_id', $request->direct_department_id);
        }
        return $query;
    }
    
}
