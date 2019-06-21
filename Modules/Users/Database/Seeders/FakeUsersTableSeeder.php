<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;

class FakeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        DB::table(User::table())->truncate();

        $nationalID = 1000000000;

        for($i=1; $i<=30; $i++) {
            $name        = 'user'. $i;
            $nationalID  = $nationalID+1;
            $phoneNumber = 0500000000 + $i;
            $jobRoleID   = rand(1,12);

            $userData = User::create([
                            'name' => $name,
                            'national_id' => $nationalID,
                            'email' => $name .'@mu.edu.sa',
                            'phone_number' => $phoneNumber,
                            'direct_department_id' => rand(3,8),
                            'is_super_admin' => $i <= 10 ? true : false,
                            'job_role_id' => $jobRoleID,
                        ]);
            $userData->groups()->attach($jobRoleID);
        }
    }
}
