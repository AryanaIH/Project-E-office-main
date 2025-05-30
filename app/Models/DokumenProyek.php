<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisSurat;

class DokumenProyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'pra_proyek_id',
        'jenis_dokumen',
        'nama_file',
    ];

    public function praProyek()
    {
        return $this->belongsTo(PraProyek::class);
    }
    
    public function jenisSurat()
{
    return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
}

}
