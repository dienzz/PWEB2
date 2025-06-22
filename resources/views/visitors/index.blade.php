@extends('layouts.app')

@section('title', 'Data Pengunjung')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pengunjung</h1>
    <a href="{{ route('visitors.create') }}" class="btn btn-primary">Tambah Pengunjung</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('visitors.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-3">
                <label for="search" class="visually-hidden">Cari Pengunjung</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Cari nama, no. kartu..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label for="status_filter" class="visually-hidden">Filter Status</label>
                <select class="form-select" id="status_filter" name="status_filter">
                    <option value="">Semua Status</option>
                    <option value="in" {{ request('status_filter') == 'in' ? 'selected' : '' }}>Masuk</option>
                    <option value="out" {{ request('status_filter') == 'out' ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-dark me-2">Cari & Filter</button>
                <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>No. Kartu Member</th>
                <th>Nama Pengunjung</th>
                <th>Status</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Photo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visitors as $visitor)
                <tr>
                    <td>{{ ($visitors->currentPage() - 1) * $visitors->perPage() + $loop->iteration }}</td>
                    <td>{{ $visitor->no_kartu ?? '-' }}</td>
                    <td>{{ $visitor->nama }}</td>
                    <td>{{ ucfirst($visitor->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($visitor->waktu_masuk)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $visitor->waktu_keluar ? \Carbon\Carbon::parse($visitor->waktu_keluar)->format('d-m-Y H:i:s') : 'Belum keluar' }}</td>
                    <td>
                        @if ($visitor->photo)
                            <img src="{{ asset('storage/' . $visitor->photo) }}" alt="Photo" width="50" class="img-thumbnail">
                        @else
                            Tidak ada photo
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('visitors.edit', $visitor->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengunjung ini?')" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data pengunjung.</td> {{-- Adjusted colspan to 8 --}}
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $visitors->links() }}
</div>
@endsection