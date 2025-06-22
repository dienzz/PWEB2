@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pembayaran</h1>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('payments.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-3">
                <label for="search" class="visually-hidden">Cari Pembayaran</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Cari no. kartu/nama member..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label for="jenis_langganan_filter" class="visually-hidden">Filter Jenis Langganan</label>
                <select class="form-select" id="jenis_langganan_filter" name="jenis_langganan_filter">
                    <option value="">Semua Jenis Langganan</option>
                    <option value="harian" {{ request('jenis_langganan_filter') == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="mingguan" {{ request('jenis_langganan_filter') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ request('jenis_langganan_filter') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="status_filter" class="visually-hidden">Filter Status</label>
                <select class="form-select" id="status_filter" name="status_filter">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="failed" {{ request('status_filter') == 'failed' ? 'selected' : '' }}>Gagal</option>
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
                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                <th>Jenis Langganan</th>
                <th>Harga</th>
                <th>Status</th> {{-- Added Status column --}}
                <th>Tanggal Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}</td>
                    <td>{{ $payment->no_kartu }}</td>
                    <td>{{ $payment->member->nama ?? 'N/A' }}</td>
                    <td>{{ ucfirst($payment->jenis_langganan) }}</td>
                    <td>Rp {{ number_format($payment->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($payment->status == 'completed')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($payment->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data pembayaran.</td> {{-- Adjusted colspan to 8 --}}
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $payments->links() }}
</div>
@endsection