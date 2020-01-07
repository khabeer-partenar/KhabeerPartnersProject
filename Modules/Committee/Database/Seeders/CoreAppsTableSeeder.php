<?php

namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\App;
use Illuminate\Database\Seeder;

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

        $generalResourceName = "Modules\Committee\Http\Controllers";

        $committeeAppId = App::create([
            'resource_name' => $generalResourceName.' ', 'name' => 'المعاملات',
            'icon' => 'fa fa-files-o', 'sort' => 3, 'parent_id' => 1, 'frontend_path' => 'committees', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@delegate', 'name' => 'طلب المندوبين',
            'icon' => 'fa fa-user-plus', 'sort' => 1, 'parent_id' => $committeeAppId, 'frontend_path' => 'committees/assign-delegate', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $committeesId = App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@index', 'name' => 'مجلد المعاملات',
            'icon' => 'fa fa-file-o', 'sort' => 2, 'parent_id' => $committeeAppId, 'frontend_path' => 'committees', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@create', 'name' => 'اضافة لجنة جديد',
            'icon' => 'fa fa-file-o', 'sort' => 1, 'parent_id' => $committeesId, 'frontend_path' => 'committees/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@store', 'name' => 'حفظ لجنة جديد',
            'icon' => 'fa fa-file-o','sort' => 2, 'parent_id' => $committeesId, 'frontend_path' => 'committees', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@show', 'name' => 'عرض اللجنة',
            'icon' => 'fa fa-file-o','sort' => 4, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@edit', 'name' => 'تعديل اللجنة',
            'icon' => 'fa fa-file-o','sort' => 5, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@update', 'name' => 'تحديث اللجنة',
            'icon' => 'fa fa-file-o','sort' => 6, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@destroy', 'name' => 'حذف اللجنة',
            'icon' => 'fa fa-file-o','sort' => 8, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeDocumentController@upload', 'name' => 'إضافة ملفات اللجنة',
            'icon' => 'fa fa-file-o','sort' => 9, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeDocumentController@delete', 'name' => 'حذف ملفات اللجنة',
            'icon' => 'fa fa-file-o','sort' => 10, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@sendNomination', 'name' => 'ارسال الترشيحات',
            'icon' => 'fa fa-file-o','sort' => 10, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@getNominationDepartmentsWithRef', 'name' => 'عرض الجهات المطلوب ترشيح مندوبين لها',
            'icon' => 'fa fa-file-o','sort' => 10, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@getDelegatesWithDetails', 'name' => 'عرض المندوبين فى تفاصيل اللجنة',
            'icon' => 'fa fa-file-o','sort' => 10, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@approveCommittee', 'name' => 'اعتماد اللجنة',
            'icon' => 'fa fa-file-o','sort' => 10, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // Committee Meetings
        $meetingsId = App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@index', 'name' => 'الإجتماعات',
            'icon' => 'fa fa-file-o', 'sort' => 1, 'parent_id' => $committeeAppId, 'frontend_path' => 'committees/:id/meetings', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;


        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@create', 'name' => 'إنشاء إجتماع',
            'icon' => 'fa fa-users', 'sort' => 2, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:id/meetings/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@store', 'name' => 'حفظ الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 3, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:id/meetings', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@show', 'name' => 'عرض الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 4, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingDocumentController@store', 'name' => 'رفع مرفقات الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 5, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingDocumentController@destroy', 'name' => 'حذف مرفقات الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 6, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
    }
}