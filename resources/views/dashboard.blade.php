@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<h2>Selamat datang, {{ session('user_name') }}</h2>
<p>Anda telah berhasil masuk ke sistem.</p>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Member Aktif</h5>
                <p class="card-text display-4">{{ $stats['active_members'] ?? 0 }}</p> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Visitor Hari Ini</h5>
                <p class="card-text display-4">{{ $stats['visitors_today'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Pembayaran Tertunda</h5>
                <p class="card-text display-4">{{ $stats['pending_payments'] ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>
@endsection