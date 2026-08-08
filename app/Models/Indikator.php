<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikators';

    protected $fillable = [
        'dimensi',
        'elemen',
        'deskripsi',
        'kategori', // 'p5' atau 'profil'
    ];

    public function nilaiChecks()
    {
        return $this->hasMany(NilaiCheck::class, 'indikator_id');
    }
}
