<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pra_proyeks', function (Blueprint $table) {
            $table->id();

            // Menyesuaikan kolom dengan master_proyeks tapi dengan nama berbeda
            $table->string('nama_proyek');
            $table->string('client')->nullable();       // dari 'client' di master_proyeks
            $table->string('lokasi_proyek')->nullable();       // dari 'lokasi_proyek' di master_proyeks
            $table->string('jenis_proyek')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('status_proyek')->nullable();       // dari 'status_proyek' di master_proyeks
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pra_proyeks');
    }
};
