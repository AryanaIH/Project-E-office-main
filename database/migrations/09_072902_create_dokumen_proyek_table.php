<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen_proyek', function (Blueprint $table) {
            $table->string('id_dokumen', 255)->primary();

            $table->unsignedBigInteger('template_dokumen')->nullable();
            $table->unsignedBigInteger('jenis_surat_id')->nullable(); // ✅ Tambahkan kolom ini

            $table->string('approval')->nullable();
            $table->timestamps();

            // Foreign key untuk template_dokumen
            $table->foreign('template_dokumen')
                  ->references('id')->on('berkas_dokumen_proyeks')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            // Foreign key untuk jenis_surat_id
            $table->foreign('jenis_surat_id')
                  ->references('id')->on('jenis_surat')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyek');
    }
};
