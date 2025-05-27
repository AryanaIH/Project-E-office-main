<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
}
