@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

<h2 class="mb-4">
    <i class="bi bi-file-earmark-text"></i>
    Laporan Transaksi
</h2>

<form method="GET" action="{{ route('transaksi.laporan') }}">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Semua</option>
                <option value="Dipinjam" {{ request('status')=='Dipinjam'?'selected':''}}>
                    Dipinjam
                </option>
                <option value="Dikembalikan" {{ request('status')=='Dikembalikan'?'selected':''}}>
                    Dikembalikan
                </option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="anggota_id" class="form-select">
                <option value="">Semua Anggota</option>
                @foreach($anggotas as $anggota)
                <option value="{{$anggota->id }}" {{request('anggota_id')==$anggota->id?'selected':''}}>
                    {{ $anggota->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                Filter
            </button>
        </div>
    </div>
</form>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-primary">
            <div class="card-body">
                <h5>Total Transaksi</h5>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-success">
            <div class="card-body">
                <h5>Total Denda</h5>
                <h2>Rp {{number_format($totalDenda, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('transaksi.laporan.pdf', request()->all()) }}" class="btn btn-danger mb-3">
    <i class="bi bi-file-earmark-pdf"></i>
    Export PDF
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>status</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksi)
        <tr>
            <td>{{ $transaksi->kode_transaksi }}</td>
            <td>{{ $transaksi->anggota->nama }}</td>
            <td>{{ $transaksi->buku->judul }}</td>
            <td>{{ $transaksi->status }}</td>
            <td>Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection