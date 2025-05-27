<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraProyek;


class DetailController extends Controller
{
    public function show($id)
{
    $proyek = PraProyek::with('dokumen')->findOrFail($id);

    // Daftar jenis dokumen yang disyaratkan
    $daftarSyarat = [
        'surat_perjanjian_kerjasama',
        'dokumen_penawaran',
        'rencana_anggaran_biaya',
        'dokumen_spesifikasi_teknis',
        'jadwal_pelaksanaan_proyek',
    ];

    $totalSyarat = count($daftarSyarat);

    // Hitung jumlah dokumen yang sudah diunggah dan sesuai dengan daftar syarat
    $dokumenUploaded = $proyek->dokumen->whereIn('jenis_dokumen', $daftarSyarat)->count();

    return view('detail', [
        'proyek' => $proyek,
        'daftarSyarat' => $daftarSyarat,
        'totalSyarat' => $totalSyarat,
        'dokumenUploaded' => $dokumenUploaded,
    ]);
}

}
