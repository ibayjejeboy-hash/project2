<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'nama_anak',
        'no_kk',
        'nik',
        'jenis_kelamin',
        'kelompok',
        'tempat_lahir',
        'tgl_lahir',
        'nama_ortu',
        'ktp',
        'pekerjaan_ortu',
        'no_hp',
        'email',
        'alamat',
        'status',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];
}
