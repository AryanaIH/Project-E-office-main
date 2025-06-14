<?php

use App\Models\JenisSurat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
    {
        Schema::create('dokumen_proyeks', function (Blueprint $table) {
            $table->string('id_dokumen')->primary();
            
            // Tambahkan di sini langsung
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();
            $table->string('nama_file'); // nama file tersimpan
            $table->string('approval');
            $table->string('id_proyeks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyeks');
    }
};
