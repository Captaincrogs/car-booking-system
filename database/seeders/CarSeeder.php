<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('cars')->insert([
       [
            'licence_plate' => 'ABC123',
            'brand' => 'Ford',
            'model' => 'Mustang',
            'category' => 'Sport',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '50',
            'horsePower' => '700',
            'top_speed' => '280',
            "image" => "mustang.jpg",
        ],
        [
            'licence_plate' => 'DEF456',
            'brand' => 'Dodge',
            'model' => 'Demon',
            'category' => 'sport',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '30',
            'horsepower' => '777',
            'top_speed' => '270',
            "image"  => "Dodge-Challenger_SRT_Hellcat_Widebody-2018-1280-02.jpg"
        ],
        [
        
            'licence_plate' => 'GHI789',
            'brand' => 'Fiat',
            'model' => 'panda',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '0',
            'daily_price' => '2',
            'horsepower' => '10',
            'top_speed' => '100',
            "image"  => "Fiat-Panda-1991-1280-01.jpg"
        ],
        [
            'licence_plate' => 'JKL012',
            'brand' => 'Fiat',
            'model' => 'Multipla',
            'category' => 'SuperSport',
            'seats' => '5',
            'gps' => '0',
            'daily_price' => '1',
            'horsepower' => '10',
            'top_speed' => '80',
            "image" => "Fiat-Multipla-2002-1280-11.jpg"
        ],
        [
            'licence_plate' => 'MNO345',
            'brand' => 'bmw',
            'model' => 'X5',
            'category' => 'Sport',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '30',
            'horsepower' => '200',
            'top_speed' => '200',
            "image" => 'BMW-X5-2019-hd.jpg'

        ],
        [
            'licence_plate' => 'PQR678',
            'brand' => 'porche',
            'model' => '911',
            'category' => 'Sport',
            'seats' => '3',
            'gps' => '1',
            'daily_price' => '60',
            'horsepower' => '500',
            'top_speed' => '300',
            "image" => 'Porsche-911_GT3_Touring-2022-hd.jpg'

        ],
        [
            'licence_plate' => 'STU901',
            'brand' => 'lamborghini',
            'model' => 'aventador',
            'category' => 'Sport',
            'seats' => '3',
            'gps' => '1',
            'daily_price' => '70',
            'horsepower' => '700',
            'top_speed' => '380',
            "image" => 'Lamborghini-Aventador_S_by_Skyler_Grey-2019-hd.jpg'
 
        ],
        [
            'licence_plate' => 'VWX345',
            'brand' => 'Volkswagen',
            'model' => 'Golf',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '60',
            'horsePower' => '120',
            'top_speed' => '200',
            "image" => 'Volkswagen-Golf-2020-hd.jpg'
        ],
        [
            'licence_plate' => 'YZU901',
            'brand' => 'Audi',
            'model' => 'A4',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '40',
            'horsepower' => '300',
            'top_speed' => '220',
            "image" => 'Audi-A4-1999-1280-01.jpg'
        ],
        [
            'licence_plate' => 'BCD123',
            'brand' => 'Ford',
            'model' => 'c-max',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'daily_price' => '40',
            'horsepower' => '200',
            'top_speed' => '200',
            "image" => 'Ford-C-MAX-2011-1280-01.jpg'
            
        ]

        ]);
    }
}
