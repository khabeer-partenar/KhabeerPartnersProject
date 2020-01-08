<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Modules\Core\Entities\App;
use Carbon\Carbon;

class CoreAccountAppsTableSeeder extends Seeder
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

        // AccountController
        $userAccountId = App::create([
            'resource_name' => $generalResourceName . '\AccountController', 'name' => 'الملف الشخصي',
            'icon' => 'fa fa-folder-o', 'sort' => 6, 'parent_id' => 1, 'frontend_path' => 'user/account', 'is_main_root' => 0,
            'displayed_in_menu' => 0 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\AccountController@edit', 'name' => 'تعديل الملف الشخصي',
            'icon' => 'fa fa-folder-o', 'sort' => 1, 'parent_id' => $userAccountId, 'frontend_path' => 'user/account/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AccountController@update', 'name' => 'تحديث الملف الشخصي',
            'icon' => 'fa fa-folder-o', 'sort' => 2, 'parent_id' => $userAccountId, 'frontend_path' => 'user/account/edit', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\AccountController@logout', 'name' => 'تسجيل الخروج',
            'icon' => 'fa fa-folder-o', 'sort' => 3, 'parent_id' => $userAccountId, 'frontend_path' => 'user/account', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);



        // SupportController
        $supportId = App::create([
            'resource_name' => $generalResourceName . '\SupportController', 'name' => 'طلب دعم',
            'icon' => 'fa fa-folder-o', 'sort' => 7, 'parent_id' => $userAccountId, 'frontend_path' => 'user/account/support/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0 , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        App::create([
            'resource_name' => $generalResourceName . '\SupportController@create', 'name' => 'انشاء الطلب',
            'icon' => 'fa fa-folder-o', 'sort' => 1, 'parent_id' => $supportId, 'frontend_path' => 'user/account/support/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SupportController@store', 'name' => 'حفظ الطلب',
            'icon' => 'fa fa-folder-o', 'sort' => 2, 'parent_id' => $supportId, 'frontend_path' => 'user/account/support/create', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SupportController@uploadAttachments', 'name' => 'رفع المرفقات',
            'icon' => 'fa fa-folder-o', 'sort' => 3, 'parent_id' => $supportId, 'frontend_path' => 'user/account/support/upload-attachments', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\SupportController@deleteAttachments', 'name' => 'حذف المرفقات',
            'icon' => 'fa fa-folder-o', 'sort' => 4, 'parent_id' => $supportId, 'frontend_path' => 'user/account/support/delete-attachments', 'is_main_root' => 0,
            'displayed_in_menu' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }

}
