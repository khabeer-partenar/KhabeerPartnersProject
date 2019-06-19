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

        Group::create([
            'parent_id' => 0, 'name' => 'مكتب معالي الرئيس', 'key' => 'office_of_the_president', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المستشار', 'key' => 'advisor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'مدير مكاتب المستشارين', 'key' => 'director_of_consultants_offices', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'السكرتير', 'key' => 'secretary', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'مستشار مشارك', 'key' => 'associate_consultant', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'مدير المحافظ', 'key' => 'portfolio_manager', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'الدعم التقني', 'key' => 'technical_support', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'الوزير', 'key' => 'minister', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'مدير مكتب الوزير', 'key' => 'director_of_the_minister_office', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المنسق', 'key' => 'coordinator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'المندوب', 'key' => 'delegate', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Group::create([
            'parent_id' => 0, 'name' => 'مندوب بالنيابة', 'key' => 'acting_delegate', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }
}
