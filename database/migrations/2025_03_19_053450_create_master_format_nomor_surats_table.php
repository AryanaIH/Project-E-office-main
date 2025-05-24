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
        Schema::create('master_format_nomor_surats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nomor_surat');
            $table->integer('id_departement');
            $table->string('format_nomor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_format_nomor_surats');
    }
};
