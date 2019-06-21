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

        // Users Module

        // UsersController
        $usersId = App::create(['resource_name' => 'Modules\Users\Http\Controllers\UsersController', 'name' => 'إدارة المستخدمين',
            'icon' => 'fa fa-users', 'sort' => 2, 'parent_id' => $topParentId, 'frontend_path' => 'users', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $entityUsersId = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\UsersController@index', 'name' => 'إدارة موظفين الهيئة',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $usersId, 'frontend_path' => 'users', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\UsersController@create', 'name' => 'اضافة مستخدم جديد',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@store', 'name' => 'حفظ مستخدم جديد',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $entityUsersId, 'frontend_path' => 'users', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@show', 'name' => 'عرض المستخدم',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@edit', 'name' => 'تعديل المستخدم',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/:id/edit', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@update', 'name' => 'تحديث المستخدم',
            'icon' => 'fa fa-users','sort' => 5, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@destroyConfirmation', 'name' => 'تاكيد حذف المستخدم',
            'icon' => 'fa fa-users','sort' => 6, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/:id/destroy', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@destroy', 'name' => 'حذف المستخدم',
            'icon' => 'fa fa-users','sort' => 7, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@searchByName', 'name' => 'البحث بالاسم',
            'icon' => 'fa fa-users','sort' => 8, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/search-by-name', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@upgrateToSuperAdmin', 'name' => 'تحديث المستخدم الى ادمن',
            'icon' => 'fa fa-users', 'sort' => 9, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/upgrate_to_super_admin/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\UsersController@groups', 'name' => 'عرض الادوار الوظيقية',
            'icon' => 'fa fa-users','sort' => 5, 'parent_id' => $entityUsersId, 'frontend_path' => 'users/groups', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // KhabeerPartnersController
        $manageKhabeerCommittees = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\KhabeerPartnersController', 'name' => 'إسناد لجان شركاء خبير',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $usersId, 'frontend_path' => 'users/khabeer-partners', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        // CoordinatorController
        $manageCoordinatorsID = App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\CoordinatorController', 'name' => 'إدارة المنسقين',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $usersId, 'frontend_path' => 'users/coordinators', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Users\Http\Controllers\CoordinatorController@create', 'name' => 'اضافة منسق جديد',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@store', 'name' => 'حفظ منسق جديد',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@show', 'name' => 'عرض المنسق',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@edit', 'name' => 'تعديل المنسق',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id/edit', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@update', 'name' => 'تحديث المنسق',
            'icon' => 'fa fa-users','sort' => 5, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@destroyConfirmation', 'name' => 'تاكيد حذف المنسق',
            'icon' => 'fa fa-users','sort' => 6, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id/destroy', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => 'Modules\Core\Http\Controllers\CoordinatorController@destroy', 'name' => 'حذف المنسق',
            'icon' => 'fa fa-users','sort' => 7, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0, 
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
