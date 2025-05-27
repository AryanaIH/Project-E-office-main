<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dokumen_syarats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen'); // misal: Surat Perjanjian Kerjasama, RAB, dll
            $table->string('kode_dokumen')->unique(); // misal: spk, rab, surat_permohonan (kode unik)
            $table->timestamps();
        });

        // Insert data dokumen syarat wajib
        DB::table('dokumen_syarats')->insert([
            ['nama_dokumen' => 'Surat Perjanjian Kerjasama (SPK)', 'kode_dokumen' => 'spk', 'created_at' => now(), 'updated_at' => now()],
            ['nama_dokumen' => 'Dokumen Penawaran', 'kode_dokumen' => 'penawaran', 'created_at' => now(), 'updated_at' => now()],
            ['nama_dokumen' => 'Rencana Anggaran Biaya (RAB)', 'kode_dokumen' => 'rab', 'created_at' => now(), 'updated_at' => now()],
            ['nama_dokumen' => 'Dokumen Spesifikasi Teknis', 'kode_dokumen' => 'spesifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_dokumen' => 'Jadwal Pelaksanaan Proyek', 'kode_dokumen' => 'jadwal', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_syarats');
    }
};
