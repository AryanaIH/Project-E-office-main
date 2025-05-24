<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenProyek extends Model
{
    protected $table = 'dokumen_proyek';
    protected $primaryKey = 'id_dokumen';
    public $incrementing = false; // Karena id_dokumen string, bukan auto increment
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokumen',
        'jenis_surat_id',
        'template_dokumen',  // path file string
        'approval',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    // HAPUS fungsi berkas() karena tidak sesuai
}
