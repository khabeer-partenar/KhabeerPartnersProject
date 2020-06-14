<?php

namespace Modules\SystemManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SystemManagement\Entities\Department;
use Carbon\Carbon;

class DepartmentsTableSeeder extends Seeder
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

        DB::table(Department::table())->truncate();

        $bodiesId = Department::create([
            'parent_id' => 0, 'name' => 'هيئات', 'type' => '1', 'key' => 'staff', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        $BodyExpertsID = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة الخبراء', 'type' => '2', 'key' => 'staff_experts', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        // Departments
        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'إدارة تقنية المعلومات', 'key' => 'it_department', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
