<?php

// app/Models/MasterProyek.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_proyek extends Model
{
    use HasFactory;

    protected $table = 'master_proyeks'; // Pastikan sesuai nama tabel di database

    protected $fillable = [
    'id_proyek',
    'nama_proyek',
    'client',
    'lokasi_proyek',
    'jenis_proyek',
    'tanggal_mulai',
    'tanggal_selesai',
    'status_proyek',
];

}
