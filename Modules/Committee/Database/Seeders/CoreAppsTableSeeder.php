<?php

namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $generalResourceName = "Modules\Committee\Http\Controllers";

        $committeeAppId = App::create([
            'resource_name' => $generalResourceName.' ', 'name' => 'المعاملات',
            'icon' => 'fa fa-files-o', 'sort' => 3, 'parent_id' => 1, 'frontend_path' => 'committees', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

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
            'resource_name' => $generalResourceName . '\CommitteeDocumentController@download', 'name' => 'تحميل ملفات اللجنة',
            'icon' => 'fa fa-file-o','sort' => 11, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:document/documents', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@sendNomination', 'name' => 'ارسال الترشيحات',
            'icon' => 'fa fa-file-o','sort' => 12, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@getNominationDepartmentsWithRef', 'name' => 'عرض الجهات المطلوب ترشيح مندوبين لها',
            'icon' => 'fa fa-file-o','sort' => 13, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@getDelegatesWithDetails', 'name' => 'عرض المندوبين فى تفاصيل اللجنة',
            'icon' => 'fa fa-file-o','sort' => 14, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
        App::create([
            'resource_name' => $generalResourceName . '\CommitteeController@approveCommittee', 'name' => 'اعتماد اللجنة',
            'icon' => 'fa fa-file-o','sort' => 15, 'parent_id' => $committeesId, 'frontend_path' => 'committees/:id', 'is_main_root' => 0,
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
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@edit', 'name' => 'تعديل إجتماع',
            'icon' => 'fa fa-users', 'sort' => 4, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@update', 'name' => 'تحديث الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 5, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@show', 'name' => 'عرض الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 6, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DelegateMeetingController@show', 'name' => 'عرض الإجتماع للمندوب',
            'icon' => 'fa fa-users', 'sort' => 10, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting/delegate', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DelegateMeetingController@update', 'name' => 'حفظ دعوة المندوب علي الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 10, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting/delegate', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        App::create([
            'resource_name' => $generalResourceName . '\CommitteeMeetingController@destroy', 'name' => 'إلغاء الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 7, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingDocumentController@store', 'name' => 'رفع مرفقات الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 8, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\MeetingDocumentController@destroy', 'name' => 'حذف مرفقات الإجتماع',
            'icon' => 'fa fa-users', 'sort' => 9, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        App::create([
            'resource_name' => $generalResourceName . '\DelegateDocumentsController@store', 'name' => 'رفع مرفقات الإجتماع الخاصة بالمندوب',
            'icon' => 'fa fa-users', 'sort' => 10, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\DelegateDocumentsController@destroy', 'name' => 'حذف مرفقات الإجتماع الخاصة بالمندوب',
            'icon' => 'fa fa-users', 'sort' => 11, 'parent_id' => $meetingsId, 'frontend_path' => 'committees/:committee/meetings/:meeting', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName.'\MeetingController@index', 'name' => 'الإجتماعات',
            'icon' => 'fa fa-files-o', 'sort' => 4, 'parent_id' => 1, 'frontend_path' => 'meetings/', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);


        // Authorized
        $authorized = App::create([
            'resource_name' => $generalResourceName.'\AuthorizedNameController@index', 'name' => 'الأسماء المصرح لهم',
            'icon' => 'fa fa-files-o', 'sort' => 1, 'parent_id' => $committeeAppId, 'frontend_path' => 'authorized-names', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName.'\AuthorizedNameController@export', 'name' => 'تصدير الأسماء المصرح لهم',
            'icon' => 'fa fa-files-o', 'sort' => 2, 'parent_id' => $authorized, 'frontend_path' => 'authorized-names/export', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName.'\AuthorizedNameController@print', 'name' => 'طباعة الأسماء المصرح لهم',
            'icon' => 'fa fa-files-o', 'sort' => 3, 'parent_id' => $authorized, 'frontend_path' => 'authorized-names/export', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // Multimedia
        App::create([
            'resource_name' => $generalResourceName.'\CommitteeMultimediaController@index', 'name' => 'مرئيات المشاركين علي مستوي اللجنة',
            'icon' => 'fa fa-files-o', 'sort' => 16, 'parent_id' => $committeesId, 'frontend_path' => 'meetings/:meeting/multimedia', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName.'\MeetingMultimediaController@index', 'name' => 'مرئيات المشاركين علي مستوي الإجتماع',
            'icon' => 'fa fa-files-o', 'sort' => 12, 'parent_id' => $meetingsId, 'frontend_path' => 'meetings/:meeting/multimedia', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        // Attendance
        App::create([
            'resource_name' => $generalResourceName.'\MeetingAttendanceController@create', 'name' => 'تأكيد حضور المشاركين',
            'icon' => 'fa fa-files-o', 'sort' => 13, 'parent_id' => $meetingsId, 'frontend_path' => 'meetings/:meeting/multimedia', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName.'\MeetingAttendanceController@store', 'name' => 'حفظ تأكيد حضور المشاركين',
            'icon' => 'fa fa-files-o', 'sort' => 14, 'parent_id' => $meetingsId, 'frontend_path' => 'meetings/:meeting/multimedia', 'is_main_root' => 1,
            'displayed_in_menu' => 1 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}