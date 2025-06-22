@extends('layouts.app')

@section('title', 'Detail Pengunjung')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pengunjung</h1>
</div>

<div class="card">
    <div class="card-header">
        Informasi Pengunjung
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3"><strong>No. Kartu Member:</strong></div>
            <div class="md-9">{{ $visitor->no_kartu ?? '-' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Nama Pengunjung:</strong></div>
            <div class="md-9">{{ $visitor->nama }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Photo:</strong></div>
            <div class="md-9">
                @if ($visitor->photo)
                    <img src="{{ asset('storage/' . $visitor->photo) }}" alt="Photo Pengunjung" width="150" class="img-thumbnail">
                @else
                    Tidak ada photo
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Status:</strong></div>
            <div class="md-9">{{ ucfirst($visitor->status) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Waktu Masuk:</strong></div>
            <div class="md-9">{{ \Carbon\Carbon::parse($visitor->waktu_masuk)->format('d-m-Y H:i:s') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Waktu Keluar:</strong></div>
            <div class="md-9">{{ $visitor->waktu_keluar ? \Carbon\Carbon::parse($visitor->waktu_keluar)->format('d-m-Y H:i:s') : 'Belum keluar' }}</div>
        </div>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection