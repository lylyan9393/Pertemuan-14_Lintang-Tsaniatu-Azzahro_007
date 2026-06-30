@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="bi bi-receipt"></i>
        Detail Transaksi
    </h2>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
</div>

{{-- ========================= --}}
{{-- Reminder Keterlambatan --}}
{{-- ========================= --}}
@if(
    $transaksi->status == 'Dipinjam'
    &&
    \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast()
)
<div class="alert alert-danger shadow-sm">
    <h5>
        <i class="bi bi-exclamation-triangle-fill"></i>
        Buku Terlambat Dikembalikan
    </h5>
    Buku ini sudah terlambat
    <strong>
        {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(now()) }}
        hari
    </strong>
    dari batas pengembalian.
    <hr>
    Estimasi denda saat ini :
    <strong class="text-danger">
        Rp
        {{ number_format(\Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(now()) * 5000,0,',','.') }}
    </strong>
</div>
@endif

{{-- ========================= --}}
{{-- Detail --}}
{{-- ========================= --}}
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-info-circle"></i>
        Informasi Transaksi
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%">Kode Transaksi</th>
                <td>{{ $transaksi->kode_transaksi }}</td>
            </tr>
            <tr>
                <th>Nama Anggota</th>
                <td>{{ $transaksi->anggota->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $transaksi->anggota->email }}</td>
            </tr>
            <tr>
                <th>Judul Buku</th>
                <td>{{ $transaksi->buku->judul }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>
                    {{ $transaksi->tanggal_pinjam->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <th>Batas Pengembalian</th>
                <td>
                    {{ $transaksi->tanggal_kembali->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($transaksi->status=='Dipinjam')
                        @if(now()->gt($transaksi->tanggal_kembali))
                            <span class="badge bg-danger">
                                Terlambat
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                Dipinjam
                            </span>
                        @endif
                    @else
                        <span class="badge bg-success">
                            Dikembalikan
                        </span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>
                    {{ $transaksi->keterangan ?? '-' }}
                </td>
            </tr>
            @if($transaksi->status=="Dikembalikan")
            <tr>
                <th>Tanggal Dikembalikan</th>
                <td>
                    {{ $transaksi->tanggal_dikembalikan
                        ? \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan)->format('d F Y')
                        : '-' }}
                </td>
            </tr>
            <tr>
                <th>Denda</th>
                <td>
                    @if($transaksi->denda>0)

                        <span class="text-danger fw-bold">
                            Rp {{ number_format($transaksi->denda,0,',','.') }}
                        </span>
                    @else
                        Rp 0

                    @endif
                </td>
            </tr>
            @endif
        </table>
    </div>
</div>

{{-- ========================= --}}
{{-- Tombol --}}
{{-- ========================= --}}
{{-- Di dalam card body detail transaksi --}}
@if($transaksi->status === 'Dipinjam')
    <button type="button" class="btn btn-success" id="btn-kembalikan">
        <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
    </button>
 
    <form id="form-kembalikan" action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-none">
        @csrf
        @method('PUT')
    </form>
@else
    @if($transaksi->tanggal_dikembalikan <= $transaksi->tanggal_kembali)
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> Dikembalikan tepat waktu pada
            {{ $transaksi->tanggal_dikembalikan->format('d M Y') }}
        </div>
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> Terlambat dikembalikan!
            Denda: Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
        </div>
    @endif
@endif
 
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btn-kembalikan')?.addEventListener('click', function() {
    Swal.fire({
        title: 'Konfirmasi Pengembalian',
        text: 'Apakah Anda yakin ingin mengembalikan buku ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        confirmButtonText: 'Ya, Kembalikan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-kembalikan').submit();
        }
    });
});
</script>
@endpush
@endsection