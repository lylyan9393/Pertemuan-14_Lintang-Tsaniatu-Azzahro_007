<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //halaman index
    public function index()
    {
        $kategori_list = [
            [
                'id' => 1,
                'kategori' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'kategori' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'kategori' => 'Web Design',
                'deskripsi' => 'Buku desain website modern',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'kategori' => 'Networking',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 10
            ],
            [
                'id' => 5,
                'kategori' => 'Cuber Secirity',
                'deskripsi' => 'Buku keamanan sistem',
                'jumlah_buku' => 8
            ]
        ];

        return view('kategori.index', compact('kategori_list'));
    }
    
    //detail buku
    public function show($id)
    {
        $kategori_list = [

            1 => [
                'id' => 1,
                'kategori' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25,
                'detail' => 'Kategori untuk belajar coding dan software development'
            ],
            2 => [
                'id' => 2,
                'kategori' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18,
                'detail' => 'Kategori database relasional dan NoSQL'
            ],
            3 => [
                'id' => 3,
                'kategori' => 'Web Design',
                'deskripsi' => 'Buku desain website modern',
                'jumlah_buku' => 12,
                'detail' => 'Belajar UI/UX dan desain website'
            ],
            4 => [
                'id' => 4,
                'kategori' => 'Networking',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 10,
                'detail' => 'Belajar jaringan LAN, WAN, dan internet'
            ],
            5 => [
                'id' => 5,
                'kategori' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan sistem',
                'jumlah_buku' => 8,
                'detail' => 'Belajar keamanan jaringan dan ethical hacking'
            ]
        ];

        if (!isset($kategori_list[$id])) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $kategori = $kategori_list[$id];

            if ($id == 1) {
                $buku_list = [
                    [
                        'judul' => 'Laravel 13',
                        'pengarang' => 'Budi Raharjo',
                        'tahun' => 2025
                    ],
                    [
                        'judul' => 'PHP Modern',
                        'pengarang' => 'Andi Wijaya',
                        'tahun' => 2024
                    ],
                    [
                        'judul' => 'Clean Code',
                        'pengarang' => 'Robert C. Martin',
                        'tahun' => 2020
                    ]
                ];
            } elseif ($id == 2) {
                $buku_list = [
                    [
                        'judul' => 'MySQL Database',
                        'pengarang' => 'Siti Aminah',
                        'tahun' => 2022
                    ],
                    [
                        'judul' => 'PostgreSQL Guide',
                        'pengarang' => 'Rina Putri',
                        'tahun' => 2023
                    ]
                ];
            } elseif ($id == 3) {
                $buku_list = [
                    [
                        'judul' => 'UI UX Design',
                        'pengarang' => 'Dedi Santoso',
                        'tahun' => 2021
                    ],
                    [
                        'judul' => 'Figma Mastery',
                        'pengarang' => 'Andi Nugroho',
                        'tahun' => 2024
                    ]
                ];
            } elseif ($id == 4) {
                $buku_list = [
                    [
                        'judul' => 'Computer Networking',
                        'pengarang' => 'Cisco Press',
                        'tahun' => 2020
                    ],
                    [
                        'judul' => 'Mikrotik Dasar',
                        'pengarang' => 'Bambang Setiawan',
                        'tahun' => 2022
                    ]
                ];
            } else {
                $buku_list = [
                    [
                        'judul' => 'Cyber Security Basic',
                        'pengarang' => 'Hacker White',
                        'tahun' => 2023
                    ],
                    [
                        'judul' => 'Ethical Hacking',
                        'pengarang' => 'Kevin Mitnick',
                        'tahun' => 2021
                    ]
                ];
            }

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    //untuk halaman search
        public function search($keyword)
    {
        $kategori_list = [
            [
                'id' => 1,
                'kategori' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'kategori' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'kategori' => 'Web Design',
                'deskripsi' => 'Buku desain website modern',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'kategori' => 'Networking',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 10
            ],
            [
                'id' => 5,
                'kategori' => 'Cuber Secirity',
                'deskripsi' => 'Buku keamanan sistem',
                'jumlah_buku' => 8
            ]
        ];

        $hasil = collect($kategori_list)->filter(function ($kategori) use ($keyword) {
            return str_contains(
                strtolower($kategori['kategori']),
                strtolower($keyword)
            );
        });

        return view('kategori.search', compact('hasil', 'keyword'));
    }
}
