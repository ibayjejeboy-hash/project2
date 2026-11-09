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
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran', 'no_kk')) {
                $table->string('no_kk', 30)->nullable()->after('nama_anak');
            }
            if (!Schema::hasColumn('pendaftaran', 'nik')) {
                $table->string('nik', 30)->nullable()->after('no_kk');
            }
            if (!Schema::hasColumn('pendaftaran', 'jenis_kelamin')) {
                $table->string('jenis_kelamin', 20)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('pendaftaran', 'kelompok')) {
                $table->string('kelompok', 50)->nullable()->after('jenis_kelamin');
            }
            if (!Schema::hasColumn('pendaftaran', 'tempat_lahir')) {
                $table->string('tempat_lahir', 100)->nullable()->after('kelompok');
            }
            if (!Schema::hasColumn('pendaftaran', 'ktp')) {
                $table->string('ktp', 30)->nullable()->after('nama_ortu');
            }
            if (!Schema::hasColumn('pendaftaran', 'pekerjaan_ortu')) {
                $table->string('pekerjaan_ortu', 100)->nullable()->after('ktp');
            }
            if (!Schema::hasColumn('pendaftaran', 'email')) {
                $table->string('email', 100)->nullable()->after('no_hp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $columns = ['no_kk', 'nik', 'jenis_kelamin', 'kelompok', 'tempat_lahir', 'ktp', 'pekerjaan_ortu', 'email'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('pendaftaran', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

