<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class berkas_dokumen_proyek extends Model
{
    protected $table = 'berkas_dokumen_proyeks';

    protected $fillable = [
        'id_proyek',
        'id_dokumen',
        'file_dok',
        'template_dipakai',
    ];

    public function dokumenProyek()
    {
        return $this->belongsTo(DokumenProyek::class, 'id_dokumen', 'id_dokumen');
    }
}