<h2 align="center">
    Laporan Transaksi Perpustakaan
</h2>
<table border="1" width="100%" cellspacing="0" cellspadding="5">
    <tr>
        <th>Kode</th>
        <th>Anggota</th>
        <th>Buku</th>
        <th>Status</th>
        <th>Denda</th>
    </tr>
    @foreach($transaksis as $t)
    <tr>
        <td>{{ $t->kode_transaksi }}</td>
        <td>{{ $t->anggota->nama }}</td>
        <td>{{ $t->buku->judul }}</td>
        <td>{{ $t->status }}</td>
        <td>Rp {{ number_format($t->denda, 0, ',', '.') }}</td>
    </tr>
    @endforeach
</table>
<br>
<strong>Total Transaksi :</strong> {{ $totalTransaksi}}
<br>
<strong>Total Denda :</strong> Rp {{ number_format($totalDenda,0,',','.') }}