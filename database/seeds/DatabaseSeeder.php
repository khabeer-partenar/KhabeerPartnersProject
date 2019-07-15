<?php

use Illuminate\Database\Seeder;
use Modules\Committee\Database\Seeders\CommitteeDatabaseSeeder;
use Modules\Core\Database\Seeders\CoreDatabaseSeeder;
use Modules\SystemManagement\Database\Seeders\SystemManagementDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoreDatabaseSeeder::class);
        $this->call(SystemManagementDatabaseSeeder::class);
        $this->call(UsersDatabaseSeeder::class);
        $this->call(CommitteeDatabaseSeeder::class);
    }
}
