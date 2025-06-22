@extends('layouts.app')

@section('title', 'Tambah Pengunjung Baru')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Pengunjung Baru</h1>
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

<form action="{{ route('visitors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="no_kartu" class="form-label">No. Kartu Member (Opsional)</label>
        <select class="form-select" id="no_kartu" name="no_kartu">
            <option value="">Pilih Member (Kosongkan jika bukan member)</option>
            @foreach ($members as $member)
                <option value="{{ $member->no_kartu }}" {{ old('no_kartu') == $member->no_kartu ? 'selected' : '' }}>
                    {{ $member->no_kartu }} - {{ $member->nama }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilih nomor kartu member jika pengunjung adalah member.</div>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Pengunjung</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
        <div class="form-text">Opsional: Unggah photo pengunjung (Max 2MB).</div>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="in" {{ old('status') == 'in' ? 'selected' : '' }}>Masuk</option>
            <option value="out" {{ old('status') == 'out' ? 'selected' : '' }}>Keluar</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
        <input type="datetime-local" class="form-control" id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk', now()->format('Y-m-d\TH:i')) }}" required>
    </div>
    <div class="mb-3">
        <label for="waktu_keluar" class="form-label">Waktu Keluar (Opsional)</label>
        <input type="datetime-local" class="form-control" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar') }}">
        <div class="form-text">Biarkan kosong jika pengunjung masih berada di GYM.</div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection