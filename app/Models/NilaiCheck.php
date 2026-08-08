<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiCheck extends Model
{
    use HasFactory;

    protected $table = 'nilai_checks';

    protected $fillable = [
        'siswa_id',
        'nilai_id',
        'indikator_id',
        'nilai',
        'kategori', // 'p5' atau 'profil'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'nilai_id');
    }
}