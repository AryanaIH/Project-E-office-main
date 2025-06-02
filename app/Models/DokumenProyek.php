<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisSurat;

class DokumenProyek extends Model
{
    protected $table = 'dokumen_proyeks';
    protected $primaryKey = 'id_dokumen'; // Jika memang memakai id_dokumen
    public $incrementing = false; // Karena formatnya seperti 'DOC-001'
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokumen',
        'jenis_surat_id',
        'nama_file',
        'approval',
        'id_proyeks',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }
}

