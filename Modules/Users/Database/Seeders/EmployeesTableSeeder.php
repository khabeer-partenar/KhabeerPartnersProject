<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;
use Carbon\Carbon;

class EmployeesTableSeeder extends Seeder
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

        DB::table('users_advisors_secretaries')->truncate();
        DB::table('committee_delegate')->truncate();
        DB::table(User::table())->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $usersData = [
            [
                'name' => 'Admin', 'national_id' => '1000000001', 'email' => 'mail-1000000001@mu.gov.sa', 'phone_number' => '0583748000',
                'main_department_id' => '1', 'parent_department_id' => '2', 'direct_department_id' => rand(3,8),
                'direct_department' => 3, 'is_super_admin' => 1, 'job_role_id' => 1,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],
        ];


        for($i=0; $i<count($usersData); $i++) {
            $userData = User::create($usersData[$i]);
            $userData->groups()->attach($usersData[$i]['job_role_id']);
        }
    }
}
