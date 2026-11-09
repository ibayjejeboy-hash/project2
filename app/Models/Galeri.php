<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'tanggal_kegiatan',
        'gambar',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    /**
     * Label representasi kategori
     */
    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            'kegiatan_guru' => 'Kegiatan Guru',
            default => 'Kegiatan Siswa',
        };
    }

    /**
     * URL Foto dengan fallback cerdas untuk lingkungan lokal / Windows XAMPP
     */
    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return asset('assets/images/placeholder.png');
        }

        // 1. Cek keberadaan file di public/storage/
        if (file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }

        // 2. Cek file di public/assets/galeri/
        $filename = basename($this->gambar);
        if (file_exists(public_path('assets/galeri/' . $filename))) {
            return asset('assets/galeri/' . $filename);
        }

        // 3. Fallback route streaming storage
        if (file_exists(storage_path('app/public/' . $this->gambar))) {
            return route('storage.serve', ['path' => $this->gambar]);
        }

        return asset('storage/' . $this->gambar);
    }

    /**
     * Scope filter kategori
     */
    public function scopeKategori($query, $kategori)
    {
        if ($kategori && in_array($kategori, ['kegiatan_siswa', 'kegiatan_guru'])) {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }
}
