<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Database\Seeders\FakeUsersTableSeeder;
<<<<<<< HEAD
=======
use Modules\Users\Database\Seeders\DepartmentsTableSeeder;
>>>>>>> origin/master

class UsersDatabaseSeeder extends Seeder
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

        $this->call(FakeUsersTableSeeder::class);
=======
        
        $this->call(FakeUsersTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
>>>>>>> origin/master
    }
}
