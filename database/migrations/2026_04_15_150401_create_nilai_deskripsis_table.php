<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_deskripsis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                  ->constrained('siswas')
                  ->onDelete('cascade');

            $table->text('agama')->nullable();
            $table->text('jati_diri')->nullable();
            $table->text('literasi')->nullable();

            $table->string('semester')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_deskripsis');
    }
};