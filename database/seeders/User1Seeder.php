<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user1')->insert([
            'name' => 'Admin GYM',
            'email' => 'admin@gmail.com',
            'password' => '@dmin_123', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}