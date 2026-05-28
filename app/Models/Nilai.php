<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'siswa_id',
        'agama',
        'jati_diri',
        'literasi',
        'semester'
    ];
}