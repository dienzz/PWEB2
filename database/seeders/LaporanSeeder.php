<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Laporan Pemasukan M001 (pendaftaran)
        Laporan::create([
            'no_kartu' => 'M001',
            'tanggal' => Carbon::today()->subMonths(2),
            'jenis_pemasukan' => 'pendaftaran',
            'jumlah' => 100000.00,
        ]);

        // Laporan Pemasukan M001 (langganan)
        Laporan::create([
            'no_kartu' => 'M001',
            'tanggal' => Carbon::today()->subMonths(2)->addDays(5),
            'jenis_pemasukan' => 'langganan',
            'jumlah' => 250000.00,
        ]);

        // Laporan Pemasukan M002 (langganan)
        Laporan::create([
            'no_kartu' => 'M002',
            'tanggal' => Carbon::today()->subMonth(),
            'jenis_pemasukan' => 'langganan',
            'jumlah' => 75000.00,
        ]);

        // Laporan Pemasukan M003 (pendaftaran)
        Laporan::create([
            'no_kartu' => 'M003',
            'tanggal' => Carbon::today()->subMonths(3),
            'jenis_pemasukan' => 'pendaftaran',
            'jumlah' => 100000.00,
        ]);

        // Laporan Pemasukan M005 (langganan)
        Laporan::create([
            'no_kartu' => 'M005',
            'tanggal' => Carbon::today()->subMonths(1),
            'jenis_pemasukan' => 'langganan',
            'jumlah' => 2500000.00,
        ]);
    }
}
