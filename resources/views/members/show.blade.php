@extends('layouts.app')

@section('title', 'Detail Member')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Member</h1>
</div>

<div class="card">
    <div class="card-header">
        Informasi Member
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3"><strong>No. Kartu:</strong></div>
            <div class="col-md-9">{{ $member->no_kartu }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Nama:</strong></div>
            <div class="col-md-9">{{ $member->nama }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Jenis Kelamin:</strong></div>
            <div class="col-md-9">{{ $member->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Alamat:</strong></div>
            <div class="col-md-9">{{ $member->alamat }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Tanggal Lahir:</strong></div>
            <div class="col-md-9">{{ \Carbon\Carbon::parse($member->tgl_lahir)->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Tanggal Mulai:</strong></div>
            <div class="col-md-9">{{ \Carbon\Carbon::parse($member->tgl_mulai)->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Tanggal Akhir:</strong></div>
            <div class="col-md-9">{{ \Carbon\Carbon::parse($member->tgl_akhir)->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>No. HP:</strong></div>
            <div class="col-md-9">{{ $member->no_hp }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Photo:</strong></div>
            <div class="col-md-9">
                @if ($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="Photo Member" width="150" class="img-thumbnail">
                @else
                    Tidak ada photo
                @endif
            </div>
        </div>
        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection