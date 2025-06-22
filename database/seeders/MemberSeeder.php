<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Anggota ke-1
        Member::create([
            'no_kartu' => 'M001',
            'nama' => 'Arthur Budi',
            'jk' => 'L',
            'alamat' => 'Jl. Merdeka No. 1, Jakarta',
            'tgl_lahir' => '1990-01-15',
            'tgl_mulai' => Carbon::today()->subMonths(2),
            'tgl_akhir' => Carbon::today()->addMonths(4),
            'no_hp' => '081234567890',
            'photo' => 'https://placehold.co/100x100/A0A0A0/FFFFFF?text=Arthur', // Placeholder foto
        ]);

        // Data Anggota ke-2
        Member::create([
            'no_kartu' => 'M002',
            'nama' => 'Fariz Amelia',
            'jk' => 'P',
            'alamat' => 'Jl. Mawar No. 5, Bandung',
            'tgl_lahir' => '1992-05-20',
            'tgl_mulai' => Carbon::today()->subMonth(),
            'tgl_akhir' => Carbon::today()->addMonths(2),
            'no_hp' => '081298765432',
            'photo' => 'https://placehold.co/100x100/A0A0A0/FFFFFF?text=Fariz', // Placeholder foto
        ]);

        // Data Anggota ke-3
        Member::create([
            'no_kartu' => 'M003',
            'nama' => 'Randi Pratama',
            'jk' => 'L',
            'alamat' => 'Jl. Sudirman No. 10, Surabaya',
            'tgl_lahir' => '1988-11-01',
            'tgl_mulai' => Carbon::today()->subMonths(3),
            'tgl_akhir' => Carbon::today()->addMonths(1),
            'no_hp' => '087811223344',
            'photo' => 'https://placehold.co/100x100/A0A0A0/FFFFFF?text=Randi', // Placeholder foto
        ]);

        // Data Anggota ke-4
        Member::create([
            'no_kartu' => 'M004',
            'nama' => 'Siti Khadijah',
            'jk' => 'P',
            'alamat' => 'Jl. Anggrek No. 12, Yogyakarta',
            'tgl_lahir' => '1995-03-10',
            'tgl_mulai' => Carbon::today()->subWeeks(3),
            'tgl_akhir' => Carbon::today()->addMonths(3),
            'no_hp' => '085678901234',
            'photo' => 'https://placehold.co/100x100/A0A0A0/FFFFFF?text=Siti', // Placeholder foto
        ]);

        // Data Anggota ke-5
        Member::create([
            'no_kartu' => 'M005',
            'nama' => 'Dani Saputra',
            'jk' => 'L',
            'alamat' => 'Jl. Pahlawan No. 7, Medan',
            'tgl_lahir' => '1993-07-25',
            'tgl_mulai' => Carbon::today()->subWeeks(1),
            'tgl_akhir' => Carbon::today()->addMonths(5),
            'no_hp' => '081122334455',
            'photo' => 'https://placehold.co/100x100/A0A0A0/FFFFFF?text=Dani', 
        ]);
    }
}
