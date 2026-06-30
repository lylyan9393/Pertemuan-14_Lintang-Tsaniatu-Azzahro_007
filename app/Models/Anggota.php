<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * 
     * @var string
     */
    protected $table = 'anggota';

    /**
     * kolom yang dapat di isi secara mass assignment.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];

    /**
     * tipe casting untuk atribut.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir'=> 'date',
        'tanggal_daftar'=> 'date',
    ];

    /**
     * accessor untuk menghitung umur.
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * accessor untuk lama menjadi anggota (dalam hari).
     */
    public function getLamaAnggotaAttribute(): int
    {
        return (int) Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }

    /**
     * Scope untuk filter anggota aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
 
    /**
     * Scope untuk filter berdasarkan jenis kelamin.
     */
    // public function scopeJenisKelamin($query, $jenisKelamin)
    // {
    //     return $query->where('jenis_kelamin', $jenisKelamin);
    // }
    //di bikin komentar karena bentrok dengan scope jenis kelamin yang tugas

    // ========== Tugas 2 pt 10 ===========

    /**
     * accessor status badge
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status == 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * accessor kategori usia
     */
    public function getKategoriUsiaAttribute(): string
    {
        if ($this->umur < 20) {
            return 'Remaja';
        } elseif ($this->umur <= 50) {
            return 'Dewasa';
        }

        return 'Senior';
    }

    /**
     * scope jenis kelamin
     */
    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    /**
     * Scope terdaftar bulan ini
     */
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('tanggal_daftar', now()->month)
                    ->whereYear('tanggal_daftar', now()->year);
    }

    // Tambahkan method ini di class Anggota
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

}
