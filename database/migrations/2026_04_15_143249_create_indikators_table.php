<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('indikators', function (Blueprint $table) {
    $table->id();
    $table->string('dimensi');
    $table->string('elemen');
    $table->text('deskripsi')->nullable();
    $table->string('kategori'); // p5 / profil
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikators');
    }
};
