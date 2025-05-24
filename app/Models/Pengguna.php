<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'master_penggunas';

    protected $fillable = [
        'id_pengguna',
        'nama_pengguna',
        'jabatan',
        'hak_akses',
        'id_departement',
        'nama_pengirim',
    ];

    public function departement()
{
    return $this->belongsTo(Departement::class, 'id_departement');
}

}
