<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Group;

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
        $coordinatorGroup = Group::where('key', 'coordinator')->first();
        $coordinatorsResources = [
            'Modules',
            'Modules\Users\Http\Controllers',
            'Modules\Users\Http\Controllers\CoordinatorController@index',
            'Modules\Users\Http\Controllers\CoordinatorController@create',
            'Modules\Users\Http\Controllers\CoordinatorController@store',
            'Modules\Users\Http\Controllers\CoordinatorController@show',
            'Modules\Users\Http\Controllers\CoordinatorController@edit',
            'Modules\Users\Http\Controllers\CoordinatorController@update',
            'Modules\Users\Http\Controllers\CoordinatorController@destroy',
            'Modules\Users\Http\Controllers\CoordinatorController@updateByCoordinator',
            'Modules\Users\Http\Controllers\DepartmentsController@loadDepartmentsByParentId',
            'Modules\Users\Http\Controllers\CoordinatorController@storeByCoordinator',
        ] ;
        $appsId = App::whereIn('resource_name', $coordinatorsResources)->pluck('id');
        foreach($appsId as $appId){
            $coordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
    }
}
