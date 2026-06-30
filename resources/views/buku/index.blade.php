@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <div>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
    </div>
</div>
 
{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tugas 3 pertemuan 11--}}
{{-- Search & filter Buku--}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('buku.search') }}" method="GET">
            <div class="row">
                {{-- Keyword --}}
                <div class="col-md-3">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari judul, pengarang..."
                        value="{{ request('keyword') }}">
                </div>

                {{-- Kategori --}}
                <div class="col-md-2">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Programming">Programming</option>
                        <option value="Database">Database</option>
                        <option value="Web Design">Web Design</option>
                        <option value="Networking">Networking</option>
                        <option value="Data Science">Data Science</option>
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="col-md-2">
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                    <a href="{{ route('buku.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
 
{{-- Filter Kategori --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-title">
            <i class="bi bi-funnel"></i> Filter Kategori:
        </h6>
        <div class="btn-group" role="group">
            <a href="{{ route('buku.index') }}" class="btn btn-sm {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua
            </a>
            <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Programming' ? 'btn-primary' : 'btn-outline-primary' }}">
                Programming
            </a>
            <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Database' ? 'btn-primary' : 'btn-outline-primary' }}">
                Database
            </a>
            <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Web Design' ? 'btn-primary' : 'btn-outline-primary' }}">
                Web Design
            </a>
            <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Networking' ? 'btn-primary' : 'btn-outline-primary' }}">
                Networking
            </a>
            <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Data Science' ? 'btn-primary' : 'btn-outline-primary' }}">
                Data Science
            </a>
        </div>
    </div>
</div>

{{-- Daftar Buku --}}
@forelse ($bukus as $buku)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-1 text-center">
                    <input type="checkbox"
                        name="buku_ids[]"
                        value="{{ $buku->id }}"
                        class="form-check-input">
                </div>
                <div class="col-md-1 text-center">
                    <i class="bi bi-book text-primary" style="font-size: 4rem;"></i>
                    <div class="mt-2">
                        <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }}">
                            {{ $buku->kategori }}
                        </span>
                    </div>
                </div>
                
                <div class="col-md-7">
                    <h5 class="card-title">
                        <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none">
                            {{ $buku->judul }}
                        </a>
                    </h5>
                    
                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-person"></i> {{ $buku->pengarang }} | 
                        <i class="bi bi-building"></i> {{ $buku->penerbit }} | 
                        <i class="bi bi-calendar"></i> {{ $buku->tahun_terbit }}
                    </p>
                    
                    @if ($buku->isbn)
                        <p class="card-text small text-muted mb-1">
                            <i class="bi bi-upc"></i> ISBN: {{ $buku->isbn }}
                        </p>
                    @endif
                    
                    @if ($buku->deskripsi)
                        <p class="card-text">
                            {{ Str::limit($buku->deskripsi, 150) }}
                        </p>
                    @endif
                </div>
                
                <div class="col-md-3 text-end">
                    <h4 class="text-primary mb-2">
                        {{ $buku->harga_format }}
                    </h4>
                    
                    <div class="mb-3">
                        @if ($buku->stok > 0)
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Tersedia
                            </span>
                            <div class="text-muted small mt-1">
                                Stok: {{ $buku->stok }} buku
                            </div>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle"></i> Habis
                            </span>
                        @endif
                    </div>
                    
                    <div class="btn-group-vertical d-grid gap-2">
                        <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        {{-- Delete Button dengan SweetAlert --}}
                        <button type="button"
                                class="btn btn-sm btn-danger w-100 btn-delete"
                                data-id="{{ $buku->id }}"
                                data-judul="{{ $buku->judul }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Tidak ada data buku
        @isset($kategori)
            dengan kategori <strong>{{ $kategori }}</strong>
        @endisset
    </div>
@endforelse
</form>
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<!-- {{-- Tugas 2 pertemuan 11 (component) --}}
{{-- Daftar Buku --}}
@if($bukus->count() > 0)
    <div class="row">
        @foreach($bukus as $item)
            <div class="col-md-4 mb-3">
                <x-buku-card
                    :buku="$item"
                    :show-actions="true"
                />
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Tidak ada data buku
        @isset($kategori)
            dengan kategori <strong>{{ $kategori }}</strong>
        @endisset
    </div>
@endif -->
 
@if ($bukus->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
            @isset($kategori)
                dari kategori <strong>{{ $kategori }}</strong>
            @endisset
        </p>
    </div>
@endif
@endsection

@push('scripts')
<script>
    // SweetAlert confirmation untuk delete
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const judul = this.dataset.judul;
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/buku/${id}`;
                    form.submit();
                }
            });
        });
    });

    // Select All Checkbox
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
    });
</script>
@endpush
