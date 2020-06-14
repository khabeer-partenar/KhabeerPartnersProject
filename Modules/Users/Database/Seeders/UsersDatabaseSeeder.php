<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Database\Seeders\NationalitiesTableSeeder;

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
        
        $this->call(CoreUsersAppsTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(CoreGroupsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CoreAccountAppsTableSeeder::class);
    }
}
