<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraProyek;


class DetailController extends Controller
{
    public function show($id)
{
    $proyek = PraProyek::withCount('dokumenProyeks')->findOrFail($id);

    // Daftar jenis dokumen yang disyaratkan
    $daftarSyarat = [
                    'surat_permohonan',
                    'rab',
                    'dokumen_teknis',
                    'proposal_teknis',
                    'izin_lokasi',
                    'kontrak_kerja'
    ];

    $totalSyarat = count($daftarSyarat);

    // Hitung jumlah dokumen yang sudah diunggah dan sesuai dengan daftar syarat
    $dokumenUploaded = $proyek->dokumen_proyeks_count;

    return view('Detail', [
        'proyek' => $proyek,
        'daftarSyarat' => $daftarSyarat,
        'totalSyarat' => $totalSyarat,
        'dokumenUploaded' => $dokumenUploaded,
    ]);
}

}
