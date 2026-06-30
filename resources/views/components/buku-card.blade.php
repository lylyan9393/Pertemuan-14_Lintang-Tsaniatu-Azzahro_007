<!-- <div class="card shadow-sm h-100">

    <div class="card-body">
        <div class="text-center mb-3">
            <i class="bi bi-book-fill text-primary" style="font-size:60px"></i>
        </div>
        <h5 class="card-title">
            {{ $buku->judul }}
        </h5>
        <p class="text-muted">
            {{ $buku->pengarang }}
        </p>
        <span class="badge bg-primary">
            {{ $buku->kategori }}
        </span>
        <hr>

        <p>
            <strong>Harga:</strong><br>
            Rp {{ number_format($buku->harga,0,',','.') }}
        </p>
        <p>
            <strong>Stok:</strong>
            {{ $buku->stok }}
        </p>
        {!! $buku->status_stok_badge !!}
    </div>

    @if($showActions)
    <div class="card-footer">

        <div class="btn-group-vertical d-grid gap-2">

            <a href="{{ route('buku.show', $buku->id) }}"
               class="btn btn-sm btn-info text-white">
                <i class="bi bi-eye"></i> Detail
            </a>

            <a href="{{ route('buku.edit', $buku->id) }}"
               class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>

            <form action="{{ route('buku.destroy', $buku->id) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku {{ $buku->judul }}?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-sm btn-danger w-100">
                    <i class="bi bi-trash"></i> Hapus
                </button>

            </form>

        </div>

    </div>
@endif

</div> -->