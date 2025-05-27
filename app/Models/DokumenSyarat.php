<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSyarat extends Model
{
    protected $table = 'dokumen_syarats'; // nama tabel

    protected $fillable = ['nama_dokumen', 'deskripsi']; // kolom yang boleh diisi massal (sesuaikan)

    // Jika kamu pakai timestamps, biarkan default true, 
    // kalau nggak, bisa set protected $timestamps = false;
}
