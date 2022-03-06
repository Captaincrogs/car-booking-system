<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
        [
            'reservation_date' => '2020-02-01',
            'reservation_time' => '12:00',
            'status' => 'pending',
            'car_id' => '1',
            'user_id' => '1',
        ],
        [
            'reservation_date' => '2020-02-01',
            'reservation_time' => '12:00',
            'status' => 'pending',
            'car_id' => '3',
            'user_id' => '2',
        ],
        [
            'reservation_date' => '2020-02-01',
            'reservation_time' => '12:00',
            'status' => 'pending',
            'car_id' => '4',
            'user_id' => '3',
        ]
        
        ]);
    }
}