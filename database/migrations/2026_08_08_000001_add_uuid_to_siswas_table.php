<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->unique()->after('id');
        });

        // Generate UUIDs for all existing siswa records
        $siswas = DB::table('siswas')->whereNull('uuid')->get();
        foreach ($siswas as $siswa) {
            DB::table('siswas')
                ->where('id', $siswa->id)
                ->update(['uuid' => (string) Str::uuid()]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
