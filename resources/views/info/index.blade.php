{{-- @extends('layouts.app')

@section('title', 'Info Mengenai GYM')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Info Mengenai Badai Fitness & Gym</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Detail Informasi</h5>
            </div>
            <div class="card-body">
                <p><strong>Lokasi:</strong> Badai Fitness & Gym berlokasi di Jl. Cirendang-Cigugur, Rw 1, Cirendang, Kec. Cigugur, Kabupaten Kuningan.</p>
                <p><strong>Layanan:</strong> Menurut akun Instagram @badaigym (diperbarui 14 Desember 2023), gym ini menawarkan layanan private trainer bagi mereka yang ingin menjalani program pembentukan tubuh. Namun, layanan ini tidak tersedia untuk kunjungan harian.</p>
                <p><strong>Biaya Keanggotaan:</strong> Biaya keanggotaan di Badai Fitness & Gym cukup terjangkau dan tidak mahal, menjadikannya pilihan yang kompetitif di wilayah Kuningan. Biaya bulanan untuk member sekitar Rp150.000 dengan biaya pendaftaran per hari Rp20.000, meskipun harga dapat bervariasi.</p>
                <p><strong>Fasilitas:</strong> Gym ini dilengkapi dengan fasilitas yang nyaman dan peralatan lengkap untuk mendukung latihan berbagai tingkat, termasuk alat kardio dan beban. Ulasan dari pengguna menyebutkan lingkungan yang memuaskan dan peralatan yang memadai untuk kebutuhan fitness.</p>
                <p><strong>Jam Operasional:</strong> Gym ini buka setiap hari dari pukul 09.00 hingga 21.00 WIB, kecuali pada hari libur nasional tertentu.</p>
                <p><strong>Informasi Tambahan:</strong> Badai Fitness & Gym dikenal sebagai tempat yang ramah, dengan komunitas yang mendukung anggota untuk mencapai tujuan kebugaran mereka. Beberapa ulasan menyebutkan bahwa gym ini telah membantu anggota meningkatkan kekuatan fisik, dengan beberapa melaporkan kenaikan berat badan hingga 10 kg dalam dua bulan. Gym ini juga aktif di media sosial untuk membagikan tips kesehatan dan update program. Tagline : <strong>GET BETTER LIFE!</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <!-- Tautan kembali ke pengaturan.index dihapus sesuai permintaan -->
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('title', 'Info Mengenai GYM')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-info-circle-fill text-success"></i>
        Info Mengenai <span class="text-primary">Badai Gym</span>
    </h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header bg-gradient bg-success text-white d-flex align-items-center">
                <i class="bi bi-lightning-charge-fill me-2 fs-4"></i>
                <h5 class="mb-0">Detail Informasi</h5>
                <span class="badge bg-warning ms-auto">Update 2024</span>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                        <strong>Lokasi:</strong>
                        <span class="ms-1">Jl. Cirendang-Cigugur, Rw 1, Cirendang, Kec. Cigugur, Kabupaten Kuningan.</span>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-person-badge-fill text-info me-2"></i>
                        <strong>Layanan:</strong>
                        <span class="ms-1">Private trainer untuk program pembentukan tubuh (tidak tersedia untuk kunjungan harian).</span>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-cash-coin text-success me-2"></i>
                        <strong>Biaya Keanggotaan:</strong>
                        <span class="ms-1">Member: <span class="fw-bold">Rp150.000/bulan</span>, Harian: <span class="fw-bold">Rp20.000</span> (harga dapat bervariasi).</span>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-barbell text-primary me-2"></i>
                        <strong>Fasilitas:</strong>
                        <span class="ms-1">Peralatan lengkap, alat kardio & beban, lingkungan nyaman & mendukung.</span>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-clock-history text-warning me-2"></i>
                        <strong>Jam Operasional:</strong>
                        <span class="ms-1">Setiap hari 09.00–21.00 WIB (tutup pada hari libur nasional tertentu).</span>
                    </li>
                </ul>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-people-fill fs-4 me-2"></i>
                    <div>
                        <strong>Komunitas Ramah:</strong> Mendukung anggota mencapai tujuan kebugaran. Banyak testimoni positif, termasuk peningkatan berat badan hingga 10 kg dalam 2 bulan!
                    </div>
                </div>
                <div class="text-center mt-4">
                    <span class="badge bg-primary fs-6 py-2 px-4">
                        <i class="bi bi-heart-pulse-fill me-1"></i>
                        GET BETTER LIFE!
                    </span>
                </div>
                <div class="text-center mt-3">
                    <a href="https://instagram.com/badaigym" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-instagram"></i> Ikuti Instagram Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection