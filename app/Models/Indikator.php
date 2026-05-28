<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    public function up(): void
{
    Schema::create('indikators', function (Blueprint $table) {
        $table->id();
        $table->string('dimensi');
        $table->string('elemen');
        $table->text('deskripsi');
        $table->timestamps();
    });
}
}
