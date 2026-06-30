@extends('layouts.app')
@section('title', 'Daftar Kategori')
@section('content')

<h1 class="mb-4">Daftar Kategori Buku</h1>

<div class="row">
    @foreach ($kategori_list as $kategori)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title">
                    {{ $kategori['kategori'] }}
                </h4>

                <p class="card-text">
                    {{ $kategori['deskripsi'] }}
                </p>

                <span class="badge bg-success mb-3">
                    {{ $kategori['jumlah_buku'] }} Buku
                </span>

                <br>

                <a href="/kategori/{{ $kategori['id'] }}" class="btn btn-primary">
                    Detail
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection