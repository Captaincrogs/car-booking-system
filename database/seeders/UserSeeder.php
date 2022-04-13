<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@rentacar.com',
                'password' => bcrypt('password'),
                'postal_code' => '',
                'city' => '',
                'adress' => '',
                'cellphone' => '',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Aimane Chouhaibi',
                'email' => 'aimane@chouhaibi.com',
                'password' => bcrypt('password'),
                'postal_code' => '75001',
                'city' => 'Paris',
                'adress' => '12 rue de la paix',
                'cellphone' => '0612345678',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
