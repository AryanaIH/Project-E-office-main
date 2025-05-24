<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'draft_surat' => 5,
            'surat_disetujui' => 12,
            'surat_terkirim' => 20,
            'proyek_baru' => 3,
            'proyek_berjalan' => 8,
            'proyek_selesai' => 15,
        ];

        $user = Auth::user();
        $role = strtolower(trim($user->role));

        if ($role === 'admin') {
            return view('Admindashboard', compact('data'));
        } elseif ($role === 'operator') {
            return view('Operatordashboard', compact('data'));
        } else {
            abort(403, 'Role tidak dikenali.');
        }
    }
}
