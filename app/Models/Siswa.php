<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use Illuminate\Http\Request;

class Siswa extends Model
{
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
    'foto'
];

public function kelas()
{
    return $this->belongsTo(Kelas::class);
}

}
