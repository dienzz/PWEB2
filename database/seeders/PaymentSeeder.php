<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Pembayaran untuk M001 (selesai)
        Payment::create([
            'no_kartu' => 'M001',
            'jenis_langganan' => 'Bulanan',
            'harga' => 250000,
            'status' => 'completed',
            'tanggal_pembayaran' => Carbon::today()->subMonths(2),
            'created_at' => Carbon::today()->subMonths(2),
            'updated_at' => Carbon::today()->subMonths(2),
        ]);

        // Pembayaran untuk M002 (selesai)
        Payment::create([
            'no_kartu' => 'M002',
            'jenis_langganan' => 'Mingguan',
            'harga' => 75000,
            'status' => 'completed',
            'tanggal_pembayaran' => Carbon::today()->subWeek(),
            'created_at' => Carbon::today()->subWeek(),
            'updated_at' => Carbon::today()->subWeek(),
        ]);

        // Pembayaran untuk M003 (pending)
        Payment::create([
            'no_kartu' => 'M003',
            'jenis_langganan' => 'Harian',
            'harga' => 30000,
            'status' => 'pending',
            'tanggal_pembayaran' => Carbon::today(),
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);

        // Pembayaran untuk M004 (gagal)
        Payment::create([
            'no_kartu' => 'M004',
            'jenis_langganan' => 'Bulanan',
            'harga' => 250000,
            'status' => 'failed',
            'tanggal_pembayaran' => Carbon::today()->subDays(10),
            'created_at' => Carbon::today()->subDays(10),
            'updated_at' => Carbon::today()->subDays(10),
        ]);

        // Pembayaran untuk M005 (selesai)
        Payment::create([
            'no_kartu' => 'M005',
            'jenis_langganan' => 'Bulanan',
            'harga' => 250000,
            'status' => 'completed',
            'tanggal_pembayaran' => Carbon::today()->subMonths(1),
            'created_at' => Carbon::today()->subMonths(1),
            'updated_at' => Carbon::today()->subMonths(1),
        ]);
    }
}
