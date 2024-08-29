<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class DeliveryBoysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_boys')->insert([
            ['name' => 'A','delivery_duration_in_minutes' => 30, 'max_orders' => 2,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'B','delivery_duration_in_minutes' => 30, 'max_orders' => 4,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'C','delivery_duration_in_minutes' => 30, 'max_orders' => 5,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'D','delivery_duration_in_minutes' => 30, 'max_orders' => 3,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
