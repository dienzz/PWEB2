@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Pembayaran</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('payments.store') }}" method="POST">
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
        <div class="form-text">Pastikan No. Kartu Member sudah terdaftar.</div>
    </div>
    <div class="mb-3">
        <label for="jenis_langganan" class="form-label">Jenis Langganan</label>
        <select class="form-select" id="jenis_langganan" name="jenis_langganan" required>
            <option value="harian" {{ old('jenis_langganan') == 'harian' ? 'selected' : '' }}>Harian</option>
            <option value="mingguan" {{ old('jenis_langganan') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
            <option value="bulanan" {{ old('jenis_langganan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status Pembayaran</label>
        <select class="form-select" id="status" name="status" required>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
        <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', now()->format('Y-m-d')) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection