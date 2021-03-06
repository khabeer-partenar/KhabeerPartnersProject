<?php

namespace Modules\Committee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CommitteeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CoreAppsTableSeeder::class);
        $this->call(CoreGroupsTableSeeder::class);
        $this->call(TreatmentTypesTableSeederTableSeeder::class);
        $this->call(TreatmentUrgencyTableSeederTableSeeder::class);
        $this->call(TreatmentImportanceTableSeederTableSeeder::class);
        $this->call(MeetingTypesTableSeeder::class);
    }
}
