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
            'resource_name' => $generalResourceName . '\CommitteController@delegate', 'name' => 'طلب المندوبين',
            'icon' => 'fa fa-user-plus', 'sort' => 1, 'parent_id' => $committeeAppId, 'frontend_path' => 'committees/assign-delegate', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        App::create([
            'resource_name' => $generalResourceName . '\CommitteController@index', 'name' => 'مجلد المعاملات',
            'icon' => 'fa fa-file-o', 'sort' => 2, 'parent_id' => $committeeAppId, 'frontend_path' => 'committees', 'is_main_root' => 0,
            'displayed_in_menu' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }
}