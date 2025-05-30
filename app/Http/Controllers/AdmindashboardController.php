<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;

class AdmindashboardController extends Controller
{
    public function index()
    {
        $jumlahDraft = SuratKeluar::where('status', 'Draft')->count();
        $jumlahDisetujui = SuratKeluar::where('status', 'Disetujui')->count();
        $jumlahTerkirim = SuratKeluar::where('status', 'Dikirim')->count();

        // Pastikan folder views/admin dan file admindashboard.blade.php sudah dibuat
        return view('admin.admindashboard', compact('jumlahDraft', 'jumlahDisetujui', 'jumlahTerkirim'));
    }
}
