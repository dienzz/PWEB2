@extends('layouts.app')

@section('title', 'Edit Pengunjung')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pengunjung</h1>
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

<form action="{{ route('visitors.update', $visitor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="no_kartu" class="form-label">No. Kartu Member (Opsional)</label>
        <select class="form-select" id="no_kartu" name="no_kartu">
            <option value="">Pilih Member (Kosongkan jika bukan member)</option>
            @foreach ($members as $member)
                <option value="{{ $member->no_kartu }}" {{ old('no_kartu', $visitor->no_kartu) == $member->no_kartu ? 'selected' : '' }}>
                    {{ $member->no_kartu }} - {{ $member->nama }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilih nomor kartu member jika pengunjung adalah member.</div>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Pengunjung</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $visitor->nama) }}" required>
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        @if ($visitor->photo)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $visitor->photo) }}" alt="Current Photo" width="100" class="img-thumbnail">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1">
                <label class="form-check-label" for="remove_photo">Hapus Photo</label>
            </div>
        @endif
        <input type="file" class="form-control" id="photo" name="photo">
        <div class="form-text">Biarkan kosong jika tidak ingin mengubah photo. Centang "Hapus Photo" untuk menghapus yang ada.</div>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="in" {{ old('status', $visitor->status) == 'in' ? 'selected' : '' }}>Masuk</option>
            <option value="out" {{ old('status', $visitor->status) == 'out' ? 'selected' : '' }}>Keluar</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
        <input type="datetime-local" class="form-control" id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk', \Carbon\Carbon::parse($visitor->waktu_masuk)->format('Y-m-d\TH:i')) }}" required>
    </div>
    <div class="mb-3">
        <label for="waktu_keluar" class="form-label">Waktu Keluar (Opsional)</label>
        <input type="datetime-local" class="form-control" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar', $visitor->waktu_keluar ? \Carbon\Carbon::parse($visitor->waktu_keluar)->format('Y-m-d\TH:i') : '') }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection