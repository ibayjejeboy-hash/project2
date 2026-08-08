<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nama_panggilan',
        'nis',
        'kelas_id',
        'jenis_kelamin',
        'user_id',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'anak_ke',
        'nama_ayah',
        'nama_ibu',
        'no_hp',
        'email',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat',
        'kode_pos',
        'kecamatan',
        'kota',
        'provinsi',
        'tanggal_diterima',
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function nilaiChecks()
    {
        return $this->hasMany(NilaiCheck::class, 'siswa_id');
    }
}
