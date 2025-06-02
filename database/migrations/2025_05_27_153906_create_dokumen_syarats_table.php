<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dokumen_syarats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen'); 
            $table->string('kode_proyeks'); 
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('dokumen_syarats');
    }
};
