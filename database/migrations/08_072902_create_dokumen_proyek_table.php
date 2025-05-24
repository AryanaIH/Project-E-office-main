<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen_proyek', function (Blueprint $table) {
        $table->string('id_dokumen', 255)->primary();
        $table->string('template_dokumen')->nullable();  // path file
        $table->unsignedBigInteger('jenis_surat_id');
        $table->string('approval')->nullable();
        $table->timestamps();

        $table->foreign('jenis_surat_id')->references('id')->on('jenis_surat')->onDelete('cascade');
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyek');
    }
};
