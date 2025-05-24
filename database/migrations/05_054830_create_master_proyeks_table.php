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
        Schema::create('master_proyeks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_proyek');
            $table->string('nama_proyek');
            $table->string('client');
            $table->string('lokasi_proyek');
            $table->string('jenis_proyek');
            $table->integer('tanggal_mulai_selesai');
            $table->string('status_proyek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_proyeks');
    }
};
