<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berkas_dokumen_proyeks', function (Blueprint $table) {
    $table->id(); // INI PENTING: id() otomatis unsignedBigInteger
    // Tambahkan kolom lain yang dibutuhkan
    $table->timestamps();


    // Pastikan tipe ini sesuai dengan kolom yang dituju
    $table->unsignedBigInteger('template_dokumen')->nullable();

    // Foreign key template_dokumen
    $table->foreign('template_dokumen')
          ->references('id')->on('berkas_dokumen_proyeks')
          ->onDelete('set null')
          ->onUpdate('cascade');

    $table->string('approval')->nullable();

    // Jangan buat foreign key jika kolomnya tidak ada
    // Hapus bagian berikut kecuali kamu memang punya kolom 'jenis_surat_id'
    // $table->foreign('jenis_surat_id')
    //       ->references('id')->on('jenis_surat')
    //       ->onDelete('cascade');
});



    }

    public function down(): void
{
    Schema::dropIfExists('dokumen_proyek');
}

};
