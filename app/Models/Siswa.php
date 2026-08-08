<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'uuid',
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

    protected static function booted()
    {
        static::creating(function ($siswa) {
            if (empty($siswa->uuid)) {
                $siswa->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Scope to find a Siswa by UUID or fallback ID.
     */
    public function scopeByIdentifier($query, $identifier)
    {
        return $query->where(function ($q) use ($identifier) {
            $q->where('uuid', $identifier)
              ->orWhere('id', $identifier);
        });
    }

    /**
     * Resolves a Siswa model by UUID or fallback ID.
     */
    public static function findByIdentifierOrFail($identifier)
    {
        return static::byIdentifier($identifier)->firstOrFail();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

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
