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
    Schema::create('nilais', function (Blueprint $table) {
        $table->id();

        $table->foreignId('siswa_id')->constrained()->onDelete('cascade');

        $table->string('semester');

        // GANTI LANGSUNG KE ENUM
        $table->enum('nilai_akhlak', ['cukup','baik','sangat_baik']);
        $table->enum('nilai_mandiri', ['cukup','baik','sangat_baik']);

        $table->text('catatan')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};