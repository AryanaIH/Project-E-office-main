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
        Schema::create('pra_proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('klient')->nullable(); // Menambahkan kolom 'klient'
            $table->string('lokasi')->nullable(); // Menambahkan kolom 'lokasi'
            $table->string('jenis_proyek')->nullable(); // Menambahkan kolom 'jenis_proyek'
            $table->date('tanggal_mulai')->nullable(); // Menambahkan kolom 'tanggal_mulai'
            $table->date('tanggal_selesai')->nullable(); // Menambahkan kolom 'tanggal_selesai'
            $table->string('status')->nullable(); // Menambahkan kolom 'status'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_proyeks');
    }
};
