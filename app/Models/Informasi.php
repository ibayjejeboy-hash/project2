<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    public function up(): void
{
    Schema::create('informasis', function (Blueprint $table) {
        $table->id();
        $table->text('visi')->nullable();
        $table->text('misi')->nullable();
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

protected $fillable = ['visi', 'misi', 'deskripsi'];
}
