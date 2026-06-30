<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Rules\KodeBukuFormat;     //tugas 2 pertemuan 12

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bukus = Buku::latest()->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok',0)->count();

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis'
        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');    // pertemuan 12
    }

    // /**
    //  * Store a newly created resource in storage.   (PRAKTIKUM)
    //  */
    // public function store(StoreBukuRequest $request)
    // {
    //     try {
    //         // Create buku baru dengan validates data
    //         Buku::create($request->validated());

    //         // redirect dengan success massage
    //         return redirect()->route('buku.index')
    //                          ->with('success','Buku berhasil ditambahkan!');

    //     } catch (\Exception $e) {
    //         //redirect dengan error massage jika gagal
    //         return redirect()->back()
    //                          ->withInput()
    //                          ->with('error', 'Gagal menambahkan buku:' . $e->getMessage());
    //     }
    // }

    /**
     * Store a newly created resource in storage.   (TUGAS 1 PR 12)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => [
                'required',
                'unique:buku,kode_buku',
                new KodeBukuFormat
            ],
            'judul' => 'required|min:3|max:255',
            'kategori' => 'required',
            'pengarang' => 'required|min:3',
            'penerbit' => 'required|min:3',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'bahasa' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.min' => 'Judul buku minimal 3 karakter.',
            'pengarang.required' => 'Nama pengarang wajib diisi.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'harga.required' => 'Harga buku wajib diisi.',
            'stok.required' => 'Stok buku wajib diisi.',
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.'
        ]);

        // ====================================
        // Conditional Validation
        // ====================================

        if (
            $request->kategori == 'Programming' &&
            $request->bahasa != 'Inggris'
        ) {
            return back()
                ->withErrors([
                    'bahasa' => 'Buku kategori Programming harus menggunakan bahasa Inggris.'
                ])
                ->withInput();
        }

        if (
            $request->tahun_terbit < 2000 &&
            $request->stok > 5
        ) {
            return back()
                ->withErrors([
                    'stok' => 'Buku terbit sebelum tahun 2000 hanya boleh memiliki stok maksimal 5.'
                ])
                ->withInput();
        }

        // ====================================
        // Simpan Data
        // ====================================

        Buku::create($request->all());

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.    PERTEMUAN 12
     */
    public function edit(string $id)
    {
        //
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.          PERTEMUAN 12
     */
    public function update(UpdateBukuRequest $request, string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            
            // Update buku dengan validated data
            $buku->update($request->validated());
            
            // Redirect dengan success message
            return redirect()->route('buku.show', $buku->id)
                            ->with('success', 'Buku berhasil diupdate!');
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal mengupdate buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.       PERTEMUAN 12 PRAKTIKUM 4
     */
    public function destroy(string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $judulBuku = $buku->judul;
            
            // Delete buku
            $buku->delete();
            
            // Redirect dengan success message
            return redirect()->route('buku.index')
                            ->with('success', "Buku '{$judulBuku}' berhasil dihapus!");
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }

    /**
     * Tambahan Method untuk tugas 2 pertemuan 12
     */

    public function bulkDelete(Request $request)
    {
        $ids = $request->buku_ids;

        if (!$ids) {
            return redirect()
                ->route('buku.index')
                ->with('error', 'Pilih minimal satu buku.');
        }

        Buku::whereIn('id', $ids)->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', count($ids) . ' buku berhasil dihapus!');
    }


    public function filterKategori($kategori)
    {
        $bukus = Buku::where('kategori', $kategori)->latest()->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok',0)->count();

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori'
        ));
    }

    //======= TUGAS 3 pertemuan 11 =======
    public function search(Request $request)
    {
        $query = Buku::query();

        // Search keyword
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                ->orWhere('pengarang', 'like', '%' . $request->keyword . '%')
                ->orWhere('penerbit', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filter kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Filter tahun
        if ($request->tahun) {
            $query->where('tahun_terbit', $request->tahun);
        }

        // Filter ketersediaan
        if ($request->status == 'tersedia') {
            $query->where('stok', '>', 0);
        }

        if ($request->status == 'habis') {
            $query->where('stok', 0);
        }

        $bukus = $query->latest()->get();

        // data tambahan untuk index
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis'
        ));
    }

    public function export()
    {
        $bukus = Buku::all();
        $filename = 'buku_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function () use ($bukus) {
            $file = fopen('php://output', 'w');
            // Header CSV
            fputcsv($file, [
                'Kode Buku',
                'Judul',
                'Kategori',
                'Pengarang',
                'Penerbit',
                'Tahun',
                'ISBN',
                'Harga',
                'Stok'
            ]);

            // Isi data
            foreach ($bukus as $buku) {
                fputcsv($file, [
                    $buku->kode_buku,
                    $buku->judul,
                    $buku->kategori,
                    $buku->pengarang,
                    $buku->penerbit,
                    $buku->tahun_terbit,
                    $buku->isbn,
                    $buku->harga,
                    $buku->stok,
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
