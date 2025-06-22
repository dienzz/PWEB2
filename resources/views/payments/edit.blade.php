@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pembayaran</h1>
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

<form action="{{ route('payments.update', $payment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="no_kartu" class="form-label">No. Kartu Member</label>
        <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="{{ old('no_kartu', $payment->no_kartu) }}" readonly>
        <div class="form-text">Nomor kartu member tidak bisa diubah.</div>
    </div>
    <div class="mb-3">
        <label for="jenis_langganan" class="form-label">Jenis Langganan</label>
        <select class="form-select" id="jenis_langganan" name="jenis_langganan" required>
            <option value="harian" {{ old('jenis_langganan', $payment->jenis_langganan) == 'harian' ? 'selected' : '' }}>Harian</option>
            <option value="mingguan" {{ old('jenis_langganan', $payment->jenis_langganan) == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
            <option value="bulanan" {{ old('jenis_langganan', $payment->jenis_langganan) == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga', $payment->harga) }}" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status Pembayaran</label>
        <select class="form-select" id="status" name="status" required>
            <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
            <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Gagal</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
        <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('Y-m-d')) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection