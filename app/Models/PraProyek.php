<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraProyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_proyek',
        'nama_proyek',
        'klient',
        'lokasi',
        'jenis_proyek',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];
}
