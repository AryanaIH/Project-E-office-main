<?php

namespace App\Http\Controllers;

use App\Models\PraProyek;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Data contoh, bisa diganti query database jika sudah tersedia
        $data = [
            'jumlahDraft'      => SuratKeluar::where('status', 'Draft')->count(),
            'jumlahDisetujui'  => SuratKeluar::where('status', 'Disetujui')->count(),
            'jumlahTerkirim'   => SuratKeluar::where('status', 'Dikirim')->count(),
            'jumlahBaru'      => PraProyek::where('status_proyek', 'baru')->count(),
            'jumlahBerjalan'  => PraProyek::where('status_proyek', 'berjalan')->count(),
            'jumlahSelesai'   => PraProyek::where('status_proyek', 'selesai')->count(),
        ];

        // Ambil user yang sedang login
        $user = Auth::user();
        $level = strtolower(trim($user->level));

        // Tampilkan dashboard sesuai level user
        if ($level === 'admin') {
            return view('Admindashboard', $data);
        } elseif ($level === 'operator') {
            return view('Operatordashboard', $data);
        } else {
            abort(403, 'Level tidak dikenali.');
        }
    }
}
