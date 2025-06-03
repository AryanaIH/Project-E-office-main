<?php

use App\Models\JenisSurat;
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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');

            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();

            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('alamat')->nullable(); // kolom alamat, boleh nullable jika ingin
            $table->text('isi_surat');
            $table->string('status')->default('Terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
