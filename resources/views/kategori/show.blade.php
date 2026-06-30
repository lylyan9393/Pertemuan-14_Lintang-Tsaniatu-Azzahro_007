@extends('layouts.app')
@section('title', 'Detail Kategori')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/kategori">Kategori</a>
        </li>
        <li class="breadcrumb-item active">
            {{ $kategori['kategori'] }}
        </li>
    </ol>
</nav>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">
            {{ $kategori['kategori'] }}
        </h3>
    </div>
    <div class="card-body">
        <p>
            <strong>Deskripsi:</strong>
            {{ $kategori['deskripsi'] }}
        </p>
        <p>
            <strong>Jumlah Buku:</strong>
            <span class="badge bg-success">
                {{ $kategori['jumlah_buku'] }}
            </span>
        </p>
    </div>
</div>

<h4>Daftar Buku</h4>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($buku_list as $index => $buku)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $buku['judul'] }}</td>
            <td>{{ $buku['pengarang'] }}</td>
            <td>{{ $buku['tahun'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="/kategori" class="btn btn-secondary">
    Kembali
</a>

@endsection