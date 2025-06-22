@extends('layouts.app')

@section('title', 'Data Laporan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Laporan</h1>
    <a href="{{ route('laporans.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('laporans.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-3">
                <label for="search" class="visually-hidden">Cari Laporan</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Cari no. kartu, nama member, jumlah..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label for="jenis_pemasukan_filter" class="visually-hidden">Filter Jenis Pemasukan</label>
                <select class="form-select" id="jenis_pemasukan_filter" name="jenis_pemasukan_filter">
                    <option value="">Semua Jenis Pemasukan</option>
                    <option value="pendaftaran" {{ request('jenis_pemasukan_filter') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                    <option value="langganan" {{ request('jenis_pemasukan_filter') == 'langganan' ? 'selected' : '' }}>Langganan</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="month_filter" class="visually-hidden">Filter Bulan</label>
                <select class="form-select" id="month_filter" name="month_filter">
                    <option value="">Semua Bulan</option>
                    @foreach ($months as $key => $monthName)
                        <option value="{{ $key }}" {{ request('month_filter') == $key ? 'selected' : '' }}>{{ $monthName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="year_filter" class="visually-hidden">Filter Tahun</label>
                <select class="form-select" id="year_filter" name="year_filter">
                    <option value="">Semua Tahun</option>
                    @for ($i = date('Y'); $i >= (date('Y') - 5); $i--)
                        <option value="{{ $i }}" {{ request('year_filter') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 d-flex mt-3">
                <button type="submit" class="btn btn-dark me-2">Cari & Filter</button>
                <a href="{{ route('laporans.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                <th>Nama Member</th>
                <th>Jenis Pemasukan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporans as $laporan)
                <tr>
                    <td>{{ ($laporans->currentPage() - 1) * $laporans->perPage() + $loop->iteration }}</td>
                    <td>{{ $laporan->no_kartu }}</td>
                    <td>{{ $laporan->member->nama ?? 'N/A' }}</td>
                    <td>{{ ucfirst($laporan->jenis_pemasukan) }}</td>
                    <td>Rp {{ number_format($laporan->jumlah, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('laporans.show', $laporan->id) }}" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('laporans.destroy', $laporan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $laporans->links() }}
</div>
@endsection