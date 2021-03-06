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
            'resource_name' => $generalResourceName . '\DepartmentController@loadDepartmentsByParentId', 'name' => 'اختيار الجهات من القوائم المنسدلة',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments/children', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@loadDepartmentsByParentIdForDelegates', 'name' => 'اختيار الجهات من القوائم المنسدلة للمندوبين',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments/children/Delegates', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@updateOrder', 'name' => 'تحديث ترتيب الإدارات',
            'icon' => 'fa fa-folder-o','sort' => 2, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments/department/:department/update-order', 'is_main_root' => 0,
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

        $departmentsAuthoritiesId = App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthorities', 'name' => 'إدارة إدارات هيئة الخبراء',
            'icon' => 'fa fa-bars', 'sort' => 5, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/departments-authorities', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthoritiesCreate', 'name' => 'انشاء',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $departmentsAuthoritiesId, 'frontend_path' => 'system-management/departments-authorities/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthoritiesStore', 'name' => 'حفط',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $departmentsAuthoritiesId, 'frontend_path' => 'system-management/departments-authorities', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthoritiesEdit', 'name' => 'تعديل',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $departmentsAuthoritiesId, 'frontend_path' => 'system-management/departments-authorities/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DepartmentController@departmentsAuthoritiesUpdate', 'name' => 'تحديث',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $departmentsAuthoritiesId, 'frontend_path' => 'system-management/departments-authorities/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $sourceRecommendationStudyId = App::create([
            'resource_name' => $generalResourceName . '\SourceRecommendationStudyController@index', 'name' => 'مصدر وتوصية الدراسة',
            'icon' => 'fa fa-bars', 'sort' => 6, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/source-recommendation-study', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\SourceRecommendationStudyController@edit', 'name' => 'تعديل',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $sourceRecommendationStudyId, 'frontend_path' => 'system-management/source-recommendation-study/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SourceRecommendationStudyController@update', 'name' => 'تحديث',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $sourceRecommendationStudyId, 'frontend_path' => 'system-management/source-recommendation-study/:department/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);



        $meetingsRoomsId = App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@index', 'name' => 'الصالات',
            'icon' => 'fa fa-bars', 'sort' => 7, 'parent_id' => $systemManagementAppId, 'frontend_path' => 'system-management/meetings-rooms', 'is_main_root' => 1,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@create', 'name' => 'انشاء',
            'icon' => 'fa fa-bars', 'sort' => 1, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@store', 'name' => 'حفظ',
            'icon' => 'fa fa-bars', 'sort' => 2, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        
        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@edit', 'name' => 'تعديل',
            'icon' => 'fa fa-bars', 'sort' => 3, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms/:room/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@update', 'name' => 'تحديث',
            'icon' => 'fa fa-bars', 'sort' => 4, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms/:room/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@destroy', 'name' => 'حذف',
            'icon' => 'fa fa-bars', 'sort' => 5, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms/:room/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingsRoomsController@roomWithMeetings', 'name' => 'عرض مواعيد الإجتماعات بالصالات',
            'icon' => 'fa fa-bars', 'sort' => 6, 'parent_id' => $meetingsRoomsId, 'frontend_path' => 'system-management/meetings-rooms/room-with-meetings', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
    }

}
