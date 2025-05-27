<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('dokumen_proyeks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pra_proyek_id')->constrained('pra_proyeks')->onDelete('cascade');
        $table->string('jenis_dokumen'); // e.g. surat_permohonan
        $table->string('nama_file'); // nama file tersimpan
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyek');
    }
};
