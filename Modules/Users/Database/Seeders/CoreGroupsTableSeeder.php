<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class CoreGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('core_permissions')->truncate();
        $basicResources = [
            'Modules',
        ];
        $coordinatorsResources = [
            'Modules\Users\Http\Controllers',
            'Modules\Users\Http\Controllers\CoordinatorController@index',
            'Modules\Users\Http\Controllers\CoordinatorController@create',
            'Modules\Users\Http\Controllers\CoordinatorController@store',
            'Modules\Users\Http\Controllers\CoordinatorController@show',
            'Modules\Users\Http\Controllers\CoordinatorController@edit',
            'Modules\Users\Http\Controllers\CoordinatorController@update',
            'Modules\Users\Http\Controllers\CoordinatorController@destroy',
            'Modules\Users\Http\Controllers\CoordinatorController@updateByCoordinator',
            'Modules\SystemManagement\Http\Controllers\DepartmentController@loadDepartmentsByParentId',
            'Modules\Users\Http\Controllers\CoordinatorController@storeByCoordinator',
            'Modules\Users\Http\Controllers\DelegateController@index',
            'Modules\Users\Http\Controllers\DelegateController@create',
            'Modules\Users\Http\Controllers\DelegateController@store',
            'Modules\Users\Http\Controllers\DelegateController@destroy',
            'Modules\Users\Http\Controllers\DelegateController@addDelegatesToCommittee',
            'Modules\Users\Http\Controllers\DelegateController@removeFromCommitte',
            'Modules\Users\Http\Controllers\DelegateController@getDepartmentDelegatesNotInCommittee',
            'Modules\Users\Http\Controllers\DelegateController@checkIfMainCoordinatorNominateDelegates'
        ];
        // Apps Ids
        $basicIds = App::whereIn('resource_name', $basicResources)->pluck('id');
        $cordId = App::whereIn('resource_name', $coordinatorsResources)->pluck('id');
        // Coordinator Permissions
        $mainCoordinatorGroup = Group::where('key', Coordinator::MAIN_CO_JOB)->first();
        foreach($basicIds as $appId){
            $mainCoordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($cordId as $appId){
            $mainCoordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        $normalCoordinatorGroup = Group::where('key', Coordinator::NORMAL_CO_JOB)->first();
        foreach($basicIds as $appId){
            $normalCoordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($cordId as $appId){
            $normalCoordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
    }
}
