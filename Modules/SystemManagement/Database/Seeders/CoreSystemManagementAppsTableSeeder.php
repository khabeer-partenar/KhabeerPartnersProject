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

        // DepartmentController
        $systemManagementAppId = App::create([
            'resource_name' => $generalResourceName, 'name' => 'إدارة النظام',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => 1, 'frontend_path' => 'system-management', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@search', 'name' => 'البحث',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments/search/:type', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $departmentsTypesId = App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsTypes', 'name' => 'إدارة أنواع الجهات',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments-types', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsTypesCreate', 'name' => 'انشاء',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $departmentsTypesId, 'frontend_path' => 'system-management/departments-types/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsTypesStore', 'name' => 'حفط',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $departmentsTypesId, 'frontend_path' => 'system-management/departments-types', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsTypesEdit', 'name' => 'تعديل',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $departmentsTypesId, 'frontend_path' => 'system-management/departments-types/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsTypesUpdate', 'name' => 'تحديث',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $departmentsTypesId, 'frontend_path' => 'system-management/departments-types/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        $departmentsManagementId = App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsManagement', 'name' => 'إدارة الجهات',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments-management', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsManagementCreate', 'name' => 'انشاء',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $departmentsManagementId, 'frontend_path' => 'system-management/departments-types/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsManagementStore', 'name' => 'حفط',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $departmentsManagementId, 'frontend_path' => 'system-management/departments-types', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsManagementEdit', 'name' => 'تعديل',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $departmentsManagementId, 'frontend_path' => 'system-management/departments-types/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsManagementUpdate', 'name' => 'تحديث',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $departmentsManagementId, 'frontend_path' => 'system-management/departments-types/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthorities', 'name' => 'إدارة إدارات هيئةالخبراء',
            'icon' => 'fa fa-bars', 'sort' => 5, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments/authorities', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }

}
