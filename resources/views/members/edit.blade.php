@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Member</h1>
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

<form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="no_kartu" class="form-label">No. Kartu</label>
        <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="{{ old('no_kartu', $member->no_kartu) }}" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $member->nama) }}" required>
    </div>
    <div class="mb-3">
        <label for="jk" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jk" name="jk" required>
            <option value="L" {{ old('jk', $member->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jk', $member->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $member->alamat) }}</textarea>
    </div>
    <div class="mb-3">
        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $member->tgl_lahir) }}" required>
    </div>
    <div class="mb-3">
        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai', $member->tgl_mulai) }}" required>
    </div>
    <div class="mb-3">
        <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="{{ old('tgl_akhir', $member->tgl_akhir) }}" required>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No. HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}" required>
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        @if ($member->photo)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $member->photo) }}" alt="Current Photo" width="100" class="img-thumbnail">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1">
                <label class="form-check-label" for="remove_photo">Hapus Photo</label>
            </div>
        @endif
        <input type="file" class="form-control" id="photo" name="photo">
        <div class="form-text">Biarkan kosong jika tidak ingin mengubah photo. Centang "Hapus Photo" untuk menghapus yang ada.</div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection