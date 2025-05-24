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
        Schema::create('master_penggunas', function (Blueprint $table) {
        $table->id();
        $table->integer('id_pengguna');
        $table->string('nama_pengguna');
        $table->string('jabatan');
        $table->string('hak_akses');
        
        // Relasi ke master_departements
        $table->unsignedBigInteger('id_departement');
        $table->foreign('id_departement')->references('id')->on('master_departements')->onDelete('cascade');

        // Tetap simpan nama_pengirim jika bukan relasi
        $table->string('nama_pengirim');

        $table->timestamps();
    });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_penggunas');
    }
};
