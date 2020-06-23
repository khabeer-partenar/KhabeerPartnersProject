<?php

namespace Modules\Users\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\SupportTickets\SupportTicketCategories;

class SuppportCategoriesTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table(SupportTicketCategories::table())->truncate();
        $categories = [
            [
                'title' => 'دعم فني تقني',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'طلب مساعدة بإجراءات العمل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'إبداء اقتراح',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        SupportTicketCategories::insert($categories);
    }
}
