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
        Schema::table('galeris', function (Blueprint $table) {
            if (!Schema::hasColumn('galeris', 'kategori')) {
                $table->string('kategori', 50)->default('kegiatan_siswa')->after('judul');
            }
            if (!Schema::hasColumn('galeris', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('kategori');
            }
            if (!Schema::hasColumn('galeris', 'tanggal_kegiatan')) {
                $table->date('tanggal_kegiatan')->nullable()->after('deskripsi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $cols = ['kategori', 'deskripsi', 'tanggal_kegiatan'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('galeris', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};

