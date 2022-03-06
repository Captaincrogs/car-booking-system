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
            'hourlyPrice' => '50',
            'horsePower' => '700',
            'top_speed' => '280',
        ],
        [
            'licence_plate' => 'DEF456',
            'brand' => 'Dodge',
            'model' => 'Demon',
            'category' => 'sport',
            'seats' => '5',
            'gps' => '1',
            'hourlyPrice' => '30',
            'horsepower' => '777',
            'top_speed' => '270',
        ],
        [
        
            'licence_plate' => 'GHI789',
            'brand' => 'Fiat',
            'model' => 'panda',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '0',
            'hourlyPrice' => '2',
            'horsepower' => '10',
            'top_speed' => '100',
        ],
        [
            'licence_plate' => 'JKL012',
            'brand' => 'Fiat',
            'model' => 'Multipla',
            'category' => 'SuperSport',
            'seats' => '5',
            'gps' => '0',
            'hourlyPrice' => '1',
            'horsepower' => '10',
            'top_speed' => '80',
        ],
        [
            'licence_plate' => 'MNO345',
            'brand' => 'bmw',
            'model' => 'X5',
            'category' => 'Sport',
            'seats' => '5',
            'gps' => '1',
            'hourlyPrice' => '30',
            'horsepower' => '200',
            'top_speed' => '200',

        ],
        [
            'licence_plate' => 'PQR678',
            'brand' => 'porche',
            'model' => '911',
            'category' => 'Sport',
            'seats' => '3',
            'gps' => '1',
            'hourlyPrice' => '60',
            'horsepower' => '500',
            'top_speed' => '300',
        ],
        [
            'licence_plate' => 'STU901',
            'brand' => 'lamborghini',
            'model' => 'aventador',
            'category' => 'Sport',
            'seats' => '3',
            'gps' => '1',
            'hourlyPrice' => '70',
            'horsepower' => '700',
            'top_speed' => '380',
        ],
        [
            'licence_plate' => 'VWX345',
            'brand' => 'Volkswagen',
            'model' => 'Golf',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'hourlyPrice' => '60',
            'horsePower' => '120',
            'top_speed' => '200',
        ],
        [
            'licence_plate' => 'YZU901',
            'brand' => 'Audi',
            'model' => 'A4',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'hourlyPrice' => '40',
            'horsepower' => '300',
            'top_speed' => '220',
        ],
        [
            'licence_plate' => 'BCD123',
            'brand' => 'Ford',
            'model' => 'c-max',
            'category' => 'Standard',
            'seats' => '5',
            'gps' => '1',
            'hourlyPrice' => '40',
            'horsepower' => '200',
            'top_speed' => '200',
            
        ]

        ]);
    }
}
