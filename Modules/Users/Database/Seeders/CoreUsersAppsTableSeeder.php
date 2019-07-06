<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Modules\Core\Entities\App;
use Carbon\Carbon;

class CoreUsersAppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $generalResourceName = 'Modules\Users\Http\Controllers';

        // UserController
        $userAppId = App::create([
            'resource_name' => $generalResourceName, 'name' => 'إدارة المستخدمين',
            'icon' => 'fa fa-users', 'sort' => 2, 'parent_id' => 1, 'frontend_path' => 'users/employees', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\UserController@search', 'name' => 'البحث في جميع المستخدمين',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $userAppId, 'frontend_path' => 'users/search', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
        // EmployeeController

        $entityEmployeeId = App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@index', 'name' => 'إدارة موظفين الهيئة',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $userAppId, 'frontend_path' => 'users/employees', 'is_main_root' => 0,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@create', 'name' => 'اضافة مستخدم جديد',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@store', 'name' => 'حفظ مستخدم جديد',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@show', 'name' => 'عرض المستخدم',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@edit', 'name' => 'تعديل المستخدم',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id/edit', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@update', 'name' => 'تحديث المستخدم',
            'icon' => 'fa fa-users','sort' => 5, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@destroy', 'name' => 'حذف المستخدم',
            'icon' => 'fa fa-users','sort' => 6, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@secretaries', 'name' => 'عرض السكرتاريين',
            'icon' => 'fa fa-users','sort' => 7, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id/secretaries', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@editSecretaries', 'name' => 'تعديل السكرتاريين',
            'icon' => 'fa fa-users','sort' => 8, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id/edit/secretaries', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@updateSecretaries', 'name' => 'تحديث السكرتاريين',
            'icon' => 'fa fa-users','sort' => 8, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/:id/edit/secretaries', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@searchByName', 'name' => 'البحث بالاسم',
            'icon' => 'fa fa-users','sort' => 9, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/search-by-name', 'is_main_root' => 0, 
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\EmployeeController@upgrateToSuperAdmin', 'name' => 'تحديث المستخدم الى ادمن',
            'icon' => 'fa fa-users', 'sort' => 10, 'parent_id' => $entityEmployeeId, 'frontend_path' => 'users/employees/upgrate_to_super_admin/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        // KhabeerPartnersController
        $manageKhabeerCommittees = App::create([
            'resource_name' => $generalResourceName . '\KhabeerPartnersController', 'name' => 'إسناد لجان شركاء خبير',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $userAppId, 'frontend_path' => 'users/khabeer-partners', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        // CoordinatorController
        $manageCoordinatorsID = App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@index', 'name' => 'إدارة المنسقين',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $userAppId, 'frontend_path' => 'users/coordinators', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@create', 'name' => 'اضافة منسق جديد',
            'icon' => 'fa fa-users', 'sort' => 1, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@store', 'name' => 'حفظ منسق جديد',
            'icon' => 'fa fa-users','sort' => 2, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@storeByCoordinator', 'name' => 'حفظ منسق جديد بواسطة منسق',
            'icon' => 'fa fa-users','sort' => 3, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/store-by-co', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@show', 'name' => 'عرض المنسق',
            'icon' => 'fa fa-users','sort' => 4, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@edit', 'name' => 'تعديل المنسق',
            'icon' => 'fa fa-users','sort' => 5, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@update', 'name' => 'تحديث المنسق',
            'icon' => 'fa fa-users','sort' => 6, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@updateByCoordinator', 'name' => 'تحديث المنسق بواسطة منسق',
            'icon' => 'fa fa-users','sort' => 7, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id/update-by-co', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CoordinatorController@destroy', 'name' => 'حذف المنسق',
            'icon' => 'fa fa-users','sort' => 8, 'parent_id' => $manageCoordinatorsID, 'frontend_path' => 'users/coordinators/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $departments = App::where('resource_name', 'Modules\Core\Http\Controllers\DepartmentsController')->first();
        if ($departments) {
            App::create([
                'resource_name' => $generalResourceName . '\DepartmentsController@loadDepartmentsByParentId', 'name' => 'اختيار الجهات',
                'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $departments->id, 'frontend_path' => 'departments', 'is_main_root' => 0,
                'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ]);
        }
    }

}
