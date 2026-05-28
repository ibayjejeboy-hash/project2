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
       Schema::create('nilai_checks', function (Blueprint $table) {
    $table->id();

    $table->foreignId('siswa_id')->constrained()->onDelete('cascade');

    // INI PENTING 🔥
    $table->foreignId('indikator_id')
          ->constrained('indikators')
          ->onDelete('cascade');

    $table->enum('nilai', ['cukup','baik','sangat_baik']);
    $table->string('kategori');

    $table->timestamps();
});
    }
    protected $fillable = [
    'siswa_id','indikator_id','nilai','kategori'
];

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_checks');
    }
};
