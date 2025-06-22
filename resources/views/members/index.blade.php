@extends('layouts.app')

@section('title', 'Data Member')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Member</h1>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Member</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('members.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-5">
                <label for="search" class="visually-hidden">Cari Member</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Cari nama, no. kartu, alamat, no. HP..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label for="jk_filter" class="visually-hidden">Filter Jenis Kelamin</label>
                <select class="form-select" id="jk_filter" name="jk_filter">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="L" {{ request('jk_filter') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jk_filter') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-dark me-2">Cari & Filter</button>
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>No. Kartu</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Tgl. Mulai</th>
                <th>Tgl. Akhir</th>
                <th>No. HP</th>
                <th>Photo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}</td>
                    <td>{{ $member->no_kartu }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ Str::limit($member->alamat, 30) }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->tgl_mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->tgl_akhir)->format('d-m-Y') }}</td>
                    <td>{{ $member->no_hp }}</td>
                    <td>
                        @if ($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="Photo" width="50" class="img-thumbnail">
                        @else
                            Tidak ada photo
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data member.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $members->links() }}
</div>
@endsection