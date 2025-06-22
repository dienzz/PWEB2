@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pembayaran</h1>
</div>

<div class="card">
    <div class="card-header">
        Informasi Pembayaran
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4"><strong>No. Kartu Member:</strong></div>
            <div class="col-md-8">{{ $payment->no_kartu }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Nama Member:</strong></div>
            <div class="col-md-8">{{ $payment->member->nama ?? 'N/A' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Jenis Langganan:</strong></div>
            <div class="col-md-8">{{ ucfirst($payment->jenis_langganan) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Harga:</strong></div>
            <div class="col-md-8">Rp{{ number_format($payment->harga, 2, ',', '.') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Status:</strong></div>
            <div class="col-md-8">
                @if($payment->status == 'completed')
                    <span class="badge bg-success">Selesai</span>
                @elseif($payment->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-danger">Gagal</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Tanggal Pembayaran:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Dibuat Pada:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Terakhir Diperbarui:</strong></div>
            <div class="col-md-8">{{ \Carbon\Carbon::parse($payment->updated_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection