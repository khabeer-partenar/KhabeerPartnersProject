<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Core\Entities\App;
use Carbon\Carbon;

class AddDefaultCoreApps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $topParentId = App::create([
            'resource_name' => 'Modules', 'name' => 'التطبيقات', 'is_main_root' => 1,
            'icon' => 'fa fa-folder-o', 'sort' => 1, 'parent_id' => 0, 'frontend_path' => 'index',
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;
      
        $coreAppsModuleId = App::create([
                'resource_name' => 'Modules\Core\Http\Controllers', 'name' => 'المصادر الرئيسية',
                'icon' => 'fa fa-folder-o','sort' => 1, 'parent_id' => $topParentId, 'frontend_path' => 'core', 'is_main_root' => 0,
                'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;
      
        $coreAppsId = App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController', 'name' => 'إدارة التطبيقات',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;
       
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController@show', 'name' => 'قراءة تفاصيل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
             'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController@store', 'name' => 'إضافة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
       
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController@update', 'name' => 'تعديل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
       
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\AppsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $coreAppsId, 'frontend_path' => 'core/apps', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
      
        $groupsId = App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController', 'name' => 'المجموعات',
            'icon' => 'fa fa-folder-o','sort' => 3, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@show', 'name' => 'اظهار بيانات',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@create', 'name' => 'صفحة انشاء جديد', 
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@store', 'name' => 'انشاء جديد',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@edit', 'name' => 'صفحة التعديل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@update', 'name' => 'تحديث',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@attachUser', 'name' => 'اضافة مستخدم',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\GroupsController@detachUser', 'name' => 'حذف مستخدم من المجموعة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $groupsId, 'frontend_path' => 'core/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $usersId = App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController', 'name' => 'المستخدمين',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/users', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-users','sort' => 1, 'parent_id' => $usersId, 'frontend_path' => 'core/users', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@upgrateToSuperAdmin', 'name' => 'تحديث المستخدم الى ادمن',
            'icon' => '-', 'sort' => 2, 'parent_id' => $usersId, 'frontend_path' => 'core/users/upgrate_to_super_admin/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        $permissionsId = App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\PermissionsController', 'name' => 'الصلاحيات',
            'icon' => 'fa fa-folder-o','sort' => 5, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\PermissionsController@index', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\PermissionsController@store', 'name' => 'اضافة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\PermissionsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $permissionsId, 'frontend_path' => 'core/permissions', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //App::truncate();
    }
}
