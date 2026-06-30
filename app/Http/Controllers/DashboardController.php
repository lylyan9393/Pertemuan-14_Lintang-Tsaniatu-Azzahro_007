<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // Statistik Buku
        // =========================
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();

        // =========================
        // Statistik Anggota
        // =========================
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        // =========================
        // Buku terbaru
        // =========================
        $bukuTerbaru = Buku::latest()->take(5)->get();

        // =========================
        // Anggota terbaru
        // =========================
        $anggotaTerbaru = Anggota::latest()->take(5)->get();

        // =========================
        // Buku Terlambat
        // =========================
        $bukuTerlambat = Transaksi::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->whereDate('tanggal_kembali', '<', now())
            ->get();

        $totalTerlambat = $bukuTerlambat->count();

        return view('home', compact(
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'bukuTerbaru',
            'anggotaTerbaru',
            'bukuTerlambat',
            'totalTerlambat'
        ));
    }
}