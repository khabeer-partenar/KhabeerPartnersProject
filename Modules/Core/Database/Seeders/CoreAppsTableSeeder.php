<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Modules\Core\Entities\App;
use Carbon\Carbon;

class CoreAppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table(App::table())->truncate();

        $generalResourceName = 'Modules\Core\Http\Controllers';

        $topParentId = App::create([
            'resource_name' => 'Modules', 'name' => 'التطبيقات', 'is_main_root' => 1,
            'icon' => 'fa fa-folder-o', 'sort' => 1, 'parent_id' => 0, 'frontend_path' => 'index',
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $coreAppsModuleId = App::create([
                'resource_name' => $generalResourceName, 'name' => 'المصادر الرئيسية',
                'icon' => 'fa fa-folder-o','sort' => 1, 'parent_id' => $topParentId, 'frontend_path' => 'core', 'is_main_root' => 0,
                'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        // AppsController
        $coreAppsId = App::create([
            'resource_name' => $generalResourceName . '\AppsController', 'name' => 'إدارة التطبيقات',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\AppsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AppsController@show', 'name' => 'قراءة تفاصيل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
             'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AppsController@store', 'name' => 'إضافة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AppsController@update', 'name' => 'تعديل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AppsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // GroupsController
        $groupsId = App::create([
            'resource_name' => $generalResourceName . '\GroupsController', 'name' => 'المجموعات',
            'icon' => 'fa fa-folder-o','sort' => 3, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@show', 'name' => 'اظهار بيانات',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@create', 'name' => 'صفحة انشاء جديد',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@store', 'name' => 'انشاء جديد',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@edit', 'name' => 'صفحة التعديل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@update', 'name' => 'تحديث',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@attachUser', 'name' => 'اضافة مستخدم',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\GroupsController@detachUser', 'name' => 'حذف مستخدم من المجموعة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // PermissionsController
        $permissionsId = App::create([
            'resource_name' => $generalResourceName . '\PermissionsController', 'name' => 'الصلاحيات',
            'icon' => 'fa fa-folder-o','sort' => 5, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\PermissionsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\PermissionsController@store', 'name' => 'اضافة',
            'icon' => 'fa fa-folder-o', 'sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\PermissionsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
    }

}
