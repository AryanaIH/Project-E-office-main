<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Data contoh, bisa diganti query database jika sudah tersedia
        $data = [
            'draft_surat'      => 5,
            'surat_disetujui'  => 12,
            'surat_terkirim'   => 20,
            'proyek_baru'      => 3,
            'proyek_berjalan'  => 8,
            'proyek_selesai'   => 15,
        ];

        // Ambil user yang sedang login
        $user = Auth::user();
        $level = strtolower(trim($user->level));

        // Tampilkan dashboard sesuai level user
        if ($level === 'admin') {
            return view('Operatordashboard', compact('data'));
        } elseif ($level === 'operator') {
            return view('Operatordashboard', compact('data'));
        } else {
            abort(403, 'Level tidak dikenali.');
        }
    }
}
