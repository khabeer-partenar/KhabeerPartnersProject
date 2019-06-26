<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Builder;

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
     * Create new User
     */
    public static function createNewUser($request)
    {
        $userData = self::create($request->only('direct_department_id', 'national_id', 'name', 'phone_number', 'email', 'job_role_id'));
        $userData->groups()->attach($request->job_role_id);
        return $userData;
    }

    /**
     * Update current user
     */
    public function updateUser($request)
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
    public function syncSecretariesUsers($secretariesIds)
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
}
