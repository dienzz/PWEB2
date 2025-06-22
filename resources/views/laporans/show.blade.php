@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Laporan</h1>
</div>

<div class="card">
    <div class="card-header">
        Informasi Laporan
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4"><strong>No. Kartu Member:</strong></div>
            <div class="col-md-8">{{ $laporan->no_kartu }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Nama Member:</strong></div>
            <div class="col-md-8">{{ $laporan->member->nama ?? 'N/A' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Tanggal:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Jenis Pemasukan:</strong></div>
            <div class="col-md-8">{{ ucfirst($laporan->jenis_pemasukan) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Jumlah:</strong></div>
            <div class="col-md-8">Rp{{ number_format($laporan->jumlah, 2, ',', '.') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Pembayaran Terkait:</strong></div>
            <div class="col-md-8">
                @if($laporan->payment)
                    {{ $laporan->payment->no_kartu }} (Rp {{ number_format($laporan->payment->harga, 2, ',', '.') }}, {{ $laporan->payment->status }})
                @else
                    Tidak ada pembayaran terkait
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Dibuat Pada:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Terakhir Diperbarui:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($laporan->updated_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection