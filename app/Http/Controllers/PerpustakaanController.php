<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    //method untuk halaman index
    public function index()
    {
        $nama_sistem = "Sistem Perpustakaan Laravel";
        $versi = "13.0";
        $total_buku = 5;

        $buku_list = [
            [
                'id' => 1,
                'judul' => 'Pemrograman PHP',
                'pengarang' => 'Budi Raharjo',
                'harga' => 75000,
                'stok' => 10
            ],
            [
                'id' => 2,
                'judul' => 'Laravel Framework',
                'pengarang' => 'Andi Nugroho',
                'harga' => 125000,
                'stok' => 5
            ],
            [
                'id' => 3,
                'judul' => 'MySQL Database',
                'pengarang' => 'Siti Aminah',
                'harga' => 95000,
                'stok' => 0
            ],
            [
                'id' => 4,
                'judul' => 'Web Design',
                'pengarang' => 'Dedi Santoso',
                'harga' => 85000,
                'stok' => 8
            ],
            [
                'id' => 5,
                'judul' => 'JavaScript Modern',
                'pengarang' => 'Rina Wijaya',
                'harga' => 80000,
                'stok' => 12
            ]
        ];

        return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list'));
    }

    //method untuk detail buku
    public function show($id)
    {
        //data buku (nanti akan dari database)
        $buku_list = [
            1 => [
                'id' => 1,
                'judul' => 'Pemrograman PHP',
                'pengarang' => 'Budi Raharjo',
                'penerbit' => 'Informatika',
                'tahun' => 2023,
                'harga' => 75000,
                'stok' => 10,
                'deskripsi' => 'Buku panduan lengkap pemrograman PHP dari dasar hingga advanced'
            ],
            2 => [
                'id' => 2,
                'judul' => 'Laravel Framework',
                'pengarang' => 'Andi Nugroho',
                'penerbit' => 'Graha Ilmu',
                'tahun' => 2024,
                'harga' => 125000,
                'stok' => 5,
                'deskripsi' => 'Membangun aplikasi web modern dengan Laravel framework'
            ],
            // ... data lainnya
            3 => [
                'id' => 3,
                'judul' => 'MySQL Database',
                'pengarang' => 'Siti Aminah',
                'penerbit' => 'Erlangga',
                'tahun' => 2022,
                'harga' => 95000,
                'stok' => 0,
                'deskripsi' => 'Pelajari Database menggunakan MySQL'
            ],
            4 => [
                'id' => 4,
                'judul' => 'Web Design',
                'pengarang' => 'Dedi Santoso',
                'penerbit' => 'Graha Ilmu',
                'tahun' => 2023,
                'harga' => 85000,
                'stok' => 8,
                'deskripsi' => 'Prinsip dan best practice dalam desain web modern'
            ],
            5 => [
                'id' => 5,
                'judul' => 'JavaScript Modern',
                'pengarang' => 'Rina Wijaya',
                'penerbit' => 'Erlangga',
                'tahun' => 2025,
                'harga' => 80000,
                'stok' => 12,
                'deskripsi' => 'Membangun aplikasi web modern dengan JavaScript modern'
            ]
        ];

        // Cek apakah buku ada
        if (!isset($buku_list[$id])) {
            abort(404, 'Buku tidak ditemukan');
        }
        
        $buku = $buku_list[$id];
        
        return view('perpustakaan.show', compact('buku'));
    }

    //method untuk halaman about
    public function about()
    {
        $info = [
            'nama' => 'Sistem Perpustakaan Laravel',
            'versi' => '1.0.0',
            'deskripsi' => 'Sistem manajemen perpustakaan berbasis Laravel framework',
            'developer' => 'Lintang Tsaniatu Azzahro',
            'tahun' => date('Y')
        ];
        
        return view('perpustakaan.about', compact('info'));
    }
}
?>