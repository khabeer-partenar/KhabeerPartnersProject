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

        // AppsController
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
      
        // GroupsController
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

        // UsersController
        $usersId = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\UsersController', 'name' => 'إدارة المستخدمين',
            'icon' => 'fa fa-users', 'sort' => 2, 'parent_id' => $topParentId, 'frontend_path' => 'users', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $entityUsersId = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\UsersController@index', 'name' => 'إدارة موظفين الهيئة',
            'icon' => 'fa fa-users','sort' => 1, 'parent_id' => $usersId, 'frontend_path' => 'users', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $manageKhabeerCommittees = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\KhabeerPartnersController', 'name' => 'إسناد لجان شركاء خبير',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $usersId, 'frontend_path' => 'users/khabeer-partners', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $manageCoordinators = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\CoordinatorController', 'name' => 'إدارة المنسقين',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $usersId, 'frontend_path' => 'users/coordinators', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@readAll', 'name' => 'قراءة الكل',
            'icon' => 'fa fa-users','sort' => 1, 'parent_id' => $entityUsersId, 'frontend_path' => 'core/users', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@store', 'name' => 'اضافة مستخدم جديد',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $entityUsersId, 'frontend_path' => 'core/users/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@upgrateToSuperAdmin', 'name' => 'تحديث المستخدم الى ادمن',
            'icon' => '-', 'sort' => 3, 'parent_id' => $entityUsersId, 'frontend_path' => 'core/users/upgrate_to_super_admin/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@groups', 'name' => 'عرض الادوار الوظيقية',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $entityUsersId, 'frontend_path' => 'core/users/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
     
        // PermissionsController
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

        // DepartmentsController
        $departmentsId = App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\DepartmentsController', 'name' => 'الادارات',
            'icon' => 'fa fa-folder-o','sort' => 6, 'parent_id' => $coreAppsModuleId, 'frontend_path' => 'core/departments', 'is_main_root' => 0,
            'displayed_in_menu' => 0 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\DepartmentsController@loadDepartmentsTypesByParentId', 'name' => 'عرض الادارات',
            'icon' => 'fa fa-folder-o','sort' => 1, 'parent_id' => $departmentsId, 'frontend_path' => 'core/departments/:parentID', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
    }
}