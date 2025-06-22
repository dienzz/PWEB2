@extends('layouts.app')

@section('title', 'Tambah Laporan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Laporan</h1>
</div>

@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('laporans.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="no_kartu" class="form-label">No. Kartu Member</label>
        <select class="form-select" id="no_kartu" name="no_kartu" required>
            <option value="">Pilih Member</option>
            @foreach ($members as $member)
                <option value="{{ $member->no_kartu }}" {{ old('no_kartu') == $member->no_kartu ? 'selected' : '' }}>
                    {{ $member->no_kartu }} - {{ $member->nama }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilih member yang terkait dengan laporan ini.</div>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Laporan</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
    </div>
    <div class="mb-3">
        <label for="jenis_pemasukan" class="form-label">Jenis Pemasukan</label>
        <select class="form-select" id="jenis_pemasukan" name="jenis_pemasukan" required>
            <option value="pendaftaran" {{ old('jenis_pemasukan') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
            <option value="langganan" {{ old('jenis_pemasukan') == 'langganan' ? 'selected' : '' }}>Langganan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
        <input type="number" step="0.01" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
    </div>
    <div class="mb-3">
        <label for="payment_id" class="form-label">Pembayaran Terkait (Opsional)</label>
        <select class="form-select" id="payment_id" name="payment_id">
            <option value="">Tidak Ada</option>
            @foreach ($payments as $payment)
                <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                    {{ $payment->no_kartu }} - Rp {{ number_format($payment->harga, 2, ',', '.') }} ({{ $payment->status }})
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilih pembayaran terkait jika ada.</div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection