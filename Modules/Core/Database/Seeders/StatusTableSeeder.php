<?php


namespace Modules\Core\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table(Status::table())->truncate();
        $status = [
            [
                'status_ar' => 'انتظار ترشيح المناديب',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'status_ar' => 'تم ارسال ا لترشيح',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'status_ar' => 'تم الترشيح',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'status_ar' => 'لم يتم الترشيح',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Status::insert($status);
    }
}