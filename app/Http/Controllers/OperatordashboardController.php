<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;

class OperatordashboardController extends Controller
{
    public function index()
    {
        $jumlahDraft = SuratKeluar::where('status', 'Draft')->count();
        $jumlahDisetujui = SuratKeluar::where('status', 'Disetujui')->count();
        $jumlahTerkirim = SuratKeluar::where('status', 'Dikirim')->count();
        return view('Operatordashboard', compact('jumlahDraft', 'jumlahDisetujui', 'jumlahTerkirim'));
    }
}
