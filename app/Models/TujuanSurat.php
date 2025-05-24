<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanSurat extends Model
{
    use HasFactory;

    protected $table = 'tujuan_surat';
    protected $primaryKey = 'id_tujuan';
    public $incrementing = false; // karena id_tujuan bukan auto-increment
    protected $keyType = 'string'; // tambahkan ini juga

    protected $fillable = [
        'id_tujuan',
        'nama_penerima',
        'instansi',
        'alamat',
        'kontak',
    ];
}
