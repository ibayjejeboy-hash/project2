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
        Schema::table('siswas', function (Blueprint $table) {
    $table->string('nama_panggilan')->nullable();
    $table->string('nisn')->nullable();
    $table->string('jenis_kelamin')->nullable();
    $table->string('tempat_lahir')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('agama')->nullable();
    $table->integer('anak_ke')->nullable();

    $table->string('nama_ayah')->nullable();
    $table->string('nama_ibu')->nullable();
    $table->string('no_hp')->nullable();
    $table->string('email')->nullable();

    $table->string('pekerjaan_ayah')->nullable();
    $table->string('pekerjaan_ibu')->nullable();

    $table->text('alamat')->nullable();
    $table->string('kode_pos')->nullable();
    $table->string('kecamatan')->nullable();
    $table->string('kota')->nullable();
    $table->string('provinsi')->nullable();

    $table->date('tanggal_diterima')->nullable();

    $table->string('foto')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            //
        });
    }
};
