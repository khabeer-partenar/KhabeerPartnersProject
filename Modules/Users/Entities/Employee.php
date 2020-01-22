<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\SystemManagement\Entities\Department;

class Employee extends User
{
    const SECRETARY = 'secretary';
    const ADVISOR = 'advisor';
    const OFFICE_OF_THE_PRESIDENT = 'office_of_the_president';
    const DIRECTOR_OF_CONSULTANTS_OFFICES = 'director_of_consultants_offices';
    const ASSOCIATE_CONSULTANT = 'associate_consultant';
    const PORTFOLIO_MANAGER = 'portfolio_manager';
    const TECHNICAL_SUPPORT = 'technical_support';
    const MINISTER = 'minister';
    const DIRECTOR_OF_THE_MINISTER_OFFICE = 'director_of_the_minister_office';
    const CHAIRMAN_OF_THE_COMMISSION = 'chairman_of_the_commission';
    const VICE_CHAIRMAN_OF_THE_COMMISSION = 'vice_chairman_of_the_commission';
    const CORDINATOR = 'cordinator';


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
        $departmentData = Department::find($request->direct_department_id);
        
        $request->merge([
            'main_department_id' => $departmentData->parent->parent_id,
            'parent_department_id' => $departmentData->parent_id,
        ]);

        $userData = self::create($request->only('main_department_id', 'parent_department_id', 'direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_role_id'));
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

        if((int)$request->national_id && $request->national_id > 0) {
            $query->where('national_id', $request->national_id);
        }

        if((int)$request->employee_email && $request->employee_email > 0) {
            $query->where('id', $request->employee_email);
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
