<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTanggalUsulanFromPraProyeksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pra_proyeks', function (Blueprint $table) {
            $table->json('dokumen')->nullable()->after('status');  // Menambahkan kolom 'dokumen'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_proyeks', function (Blueprint $table) {
            $table->dropColumn('dokumen');  // Menghapus kolom 'dokumen'
        });
    }
}
