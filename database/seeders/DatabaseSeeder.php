<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            User1Seeder::class, 
            MemberSeeder::class,
            VisitorSeeder::class,
            PaymentSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}