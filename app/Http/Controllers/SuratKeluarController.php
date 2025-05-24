<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
    // Tampilkan daftar surat keluar + FILTER
    public function index(Request $request)
    {
        $query = SuratKeluar::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_surat', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_surat', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('tujuan', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%');
            });
        }

        $suratKeluar = $query->latest()->paginate(10);

        return view('suratkeluar', compact('suratKeluar'));
    }

    // Simpan surat keluar baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'jenis_surat' => 'required|string',
            'perihal' => 'required|string',
            'tujuan' => 'required|string',
            'isi_surat' => 'required|string',
            'status' => 'nullable|string|in:Draft,Dikirim,Disetujui,Ditolak',
        ]);
        
        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'jenis_surat' => $request->jenis_surat,
            'perihal' => $request->perihal,
            'tujuan' => $request->tujuan,
            'isi_surat' => $request->isi_surat,
            'status' => $request->status ?? 'Draft',
        ]);
        
        return redirect()->back()->with('success', 'Surat berhasil disimpan.');
    }

    // Tampilkan detail surat
    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }

    // Form edit surat
    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('surat-keluar.edit', compact('surat'));
    }

    // Simpan perubahan surat
    public function update(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'status' => 'nullable|string|in:Draft,Dikirim,Disetujui,Ditolak',
        ]);
        
        $surat->update([
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'tujuan' => $request->tujuan,
            'isi_surat' => $request->isi_surat,
            'status' => $request->status ?? $surat->status,
        ]);
        
        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function preview($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $pdf = Pdf::loadView('pdf.surat-keluar', compact('surat'));
        return $pdf->stream('surat-keluar.pdf'); // menampilkan di browser
    }

    // Generate nomor surat otomatis (belum dipakai di atas)
    private function generateNomorSurat($jenis)
    {
        $latest = SuratKeluar::count() + 1;
        $bulan = date('m');
        $tahun = date('Y');
        $kode = strtoupper(substr($jenis, 0, 3));
        return sprintf("%03d/%s/%s/%s", $latest, $kode, $bulan, $tahun);
    }
}
