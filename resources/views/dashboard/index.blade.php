<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4 text-primary">
        <i class="bi bi-speedometer2"></i>
        Dashboard Perpustakaan
    </h1>

    <!-- Statistik Buku -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5>Total Buku</h5>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Buku Tersedia</h5>
                    <h2>{{ $bukuTersedia }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5>Buku Habis</h5>
                    <h2>{{ $bukuHabis }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Anggota -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h2>{{ $totalAnggota }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Anggota Aktif</h5>
                    <h2>{{ $anggotaAktif }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white mb-3">
                <div class="card-body">
                    <h5>Anggota Nonaktif</h5>
                    <h2>{{ $anggotaNonaktif }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-book"></i>
            5 Buku Terbaru
        </div>
        <ul class="list-group list-group-flush">
            @foreach($bukuTerbaru as $buku)
                <li class="list-group-item">
                    {{ $buku->judul }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Anggota Terbaru -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <i class="bi bi-people"></i>
            5 Anggota Terbaru
        </div>
        <ul class="list-group list-group-flush">
            @foreach($anggotaTerbaru as $anggota)
                <li class="list-group-item">
                    {{ $anggota->nama }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Quick Links -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-link-45deg"></i>
            Quick Links
        </div>
        <div class="card-body">
            <a href="/buku" class="btn btn-primary">
                <i class="bi bi-book"></i>
                Kelola Buku
            </a>
            <a href="/anggota" class="btn btn-success">
                <i class="bi bi-people"></i>
                Kelola Anggota
            </a>
            <a href="/kategori" class="btn btn-warning">
                <i class="bi bi-tags"></i>
                Kelola Kategori
            </a>
        </div>
    </div>
</div>

</body>
</html>