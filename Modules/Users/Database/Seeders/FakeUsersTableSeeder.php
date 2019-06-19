<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> origin/master
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
        
<<<<<<< HEAD
=======
        DB::table(User::table())->truncate();

>>>>>>> origin/master
        $nationalID = 1000000000;

        for($i=1; $i<=30; $i++) {
            $name       = 'user'. $i;
            $nationalID = $nationalID+1;
            $phoneNumber = 0500000000 + $i;

            User::create([
                'name' => $name,
                'national_id' => $nationalID,
                'email' => $name .'@mu.edu.sa',
                'phone_number' => $phoneNumber,
                'direct_department_id' => 3,
                'is_super_admin' => $i <= 10 ? true : false,
<<<<<<< HEAD
=======
                'job_role_id' => rand(1,12),
>>>>>>> origin/master
            ]);

        }
    }
}
