<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'icon' => 'code-slash',
                'warna' => 'primary'
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'icon' => 'database',
                'warna' => 'success'
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi' => 'Buku desain website dan UI/UX',
                'icon' => 'palette',
                'warna' => 'info'
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi' => 'Buku jaringan komputer',
                'icon' => 'wifi',
                'warna' => 'warning'
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi' => 'Buku analisis data dan machine learning',
                'icon' => 'graph-up',
                'warna' => 'danger'
            ]
        ];

        foreach ($kategori as $item) {
            Kategori::create($item);
        }
    }
}
