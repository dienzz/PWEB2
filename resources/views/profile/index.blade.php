@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Profil Pengguna</h1>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-header">
        Informasi Akun
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3"><strong>Nama:</strong></div>
            {{-- Pastikan ini mengambil dari 'user_name' seperti yang disimpan saat login --}}
            <div class="col-md-9">{{ session('user_name') ?? 'N/A' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Email:</strong></div>
            {{-- PERBAIKAN DI SINI: Gunakan 'user_email' --}}
            <div class="col-md-9">{{ session('user_email') ?? 'N/A' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>ID Pengguna:</strong></div>
            {{-- Ini sudah benar, menggunakan 'user_id' --}}
            <div class="col-md-9">{{ session('user_id') ?? 'N/A' }}</div>
        </div>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-header">
        Aksi
    </div>
    <div class="card-body">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

@endsection