<?php

namespace Modules\SystemManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Modules\Core\Entities\App;
use Carbon\Carbon;

class CoreSystemManagementAppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $generalResourceName = 'Modules\SystemManagement\Http\Controllers';

        // SystemManagementController
        $systemManagementAppId = App::create([
            'resource_name' => $generalResourceName, 'name' => 'إدارة النظام',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => 1, 'frontend_path' => 'system-management', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

       
        App::create([
            'resource_name' => $generalResourceName . '\SystemManagementController@departmentsTypes', 'name' => 'إدارة أنواع الجهات',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments-types', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        App::create([
            'resource_name' => $generalResourceName . '\SystemManagementController@departments', 'name' => 'إدارة الجهات',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SystemManagementController@authoritiesDepartments', 'name' => 'إدارة إدارات الهيئة',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/authorities-departments', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SystemManagementController@search', 'name' => 'البحث',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments-search/:type', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }

}
