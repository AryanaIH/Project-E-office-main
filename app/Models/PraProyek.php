<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraProyek extends Model
{
    use HasFactory;

    protected $table = 'pra_proyeks';

    protected $fillable = [
    'nama_proyek',
    'tanggal_mulai',
    'tanggal_selesai',
    'client',
    'lokasi_proyek',
    'jenis_proyek',
    'status_proyek',
    'surat_permohonan',
    'rab',
    'dokumen_teknis',
    'proposal_teknis',
    'izin_lokasi',
    'kontrak_kerja',
];

    public function dokumenProyeks()
    {
        return $this->hasMany(DokumenProyek::class,'id_proyeks');
    }
}

