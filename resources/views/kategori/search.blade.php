@extends('layouts.app')
@section('title', 'Hasil Pencarian')
@section('content')

<h1 class="mb-4">
    Hasil Pencarian:
    <span class="text-primary">
        "{{ $keyword }}"
    </span>
</h1>

@if ($hasil->count() > 0)

<div class="row">
    @foreach ($hasil as $kategori)
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

                <a href="/kategori/{{ $kategori['id'] }}"
                   class="btn btn-primary">
                    Detail
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@else

<div class="alert alert-danger">
    Kategori tidak ditemukan.
</div>

@endif
@endsection