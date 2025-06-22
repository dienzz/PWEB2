<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        // Kunjungan M001 (keluar)
        Visitor::create([
            'no_kartu' => 'M001',
            'nama' => 'Arthur Budi',
            'photo' => null, // Photo akan diambil dari data Member
            'status' => 'out',
            'waktu_masuk' => Carbon::today()->subDays(1)->setHour(8)->setMinute(0),
            'waktu_keluar' => Carbon::today()->subDays(1)->setHour(10)->setMinute(0),
        ]);

        // Kunjungan M002 (masuk)
        Visitor::create([
            'no_kartu' => 'M002',
            'nama' => 'Fariz Amelia',
            'photo' => null, // Photo akan diambil dari data Member
            'status' => 'in', // Sedang di dalam
            'waktu_masuk' => Carbon::today()->setHour(9)->setMinute(30),
            'waktu_keluar' => null,
        ]);

        // Kunjungan M003 (keluar)
        Visitor::create([
            'no_kartu' => 'M003',
            'nama' => 'Randi Pratama',
            'photo' => null, // Photo akan diambil dari data Member
            'status' => 'out',
            'waktu_masuk' => Carbon::today()->setHour(11)->setMinute(0),
            'waktu_keluar' => Carbon::today()->setHour(12)->setMinute(0),
        ]);

        // Kunjungan M004 (masuk)
        Visitor::create([
            'no_kartu' => 'M004',
            'nama' => 'Siti Khadijah',
            'photo' => null, // Photo akan diambil dari data Member
            'status' => 'in', // Sedang di dalam
            'waktu_masuk' => Carbon::today()->setHour(10)->setMinute(0),
            'waktu_keluar' => null,
        ]);

        // Kunjungan M005 (keluar)
        Visitor::create([
            'no_kartu' => 'M005',
            'nama' => 'Dani Saputra',
            'photo' => null, // Photo akan diambil dari data Member
            'status' => 'out',
            'waktu_masuk' => Carbon::today()->subHours(5),
            'waktu_keluar' => Carbon::today()->subHours(3),
        ]);
    }
}
