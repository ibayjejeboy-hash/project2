<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    public function up(): void
{
    Schema::create('galeris', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('gambar');
        $table->timestamps();
    });
}

protected $fillable = ['judul', 'gambar'];
}
