<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User1;

class User1Seeder extends Seeder
{
    public function run(): void
    {
        User1::create([
            'name' => 'Admin GYM',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('@dmin_123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}