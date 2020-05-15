<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\Group;
use Carbon\Carbon;

class DefaultGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        DB::table(Group::table())->truncate();
        DB::table('core_permissions')->truncate();
        DB::table('core_users_groups')->truncate();

        Group::create([
            'parent_id' => 0, 'name' => 'مكتب معالي الرئيس', 'key' => 'office_of_the_president', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المستشار', 'key' => 'advisor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'السكرتير', 'key' => 'secretary', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'الدعم التقني', 'key' => 'technical_support', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'منسق الجهة المرجعية', 'key' => 'main_coordinator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المنسق', 'key' => 'coordinator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المندوب', 'key' => 'delegate', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'منسق التصاريح', 'key' => 'authorizations_coordinator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'معالي رئيس الهيئة', 'key' => 'chairman_of_the_commission', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'معالي نائب رئيس الهيئة', 'key' => 'vice_chairman_of_the_commission', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }
}