<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Setelah Login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('/home', [DashboardController::class,'index'])
        ->name('home');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    // Buku
    Route::resource('buku', BukuController::class);

    Route::get('/buku/search', [BukuController::class, 'search'])  // tugas 3
    ->name('buku.search');

    Route::get('buku/kategori/{kategori}', [BukuController::class,'filterKategori'])
        ->name('buku.kategori');

    // Anggota
    Route::resource('anggota', AnggotaController::class);

    Route::get('/anggota/search',
        [AnggotaController::class,'search'])
        ->name('anggota.search');

    Route::get('/anggota/export',
        [AnggotaController::class,'export'])
        ->name('anggota.export');

    // Transaksi
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])
        ->name('transaksi.laporan');

    Route::get('/transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])
        ->name('transaksi.laporan.pdf');

    Route::resource('transaksi', TransaksiController::class);

    Route::put('/transaksi/{id}/kembalikan',
        [TransaksiController::class,'kembalikan'])
        ->name('transaksi.kembalikan');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';