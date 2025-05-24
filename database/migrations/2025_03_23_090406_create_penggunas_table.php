<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengguna')->unique();
            $table->string('nama_pengguna');
            $table->string('jabatan');
            $table->enum('hak_akses', ['admin', 'user']);
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};

