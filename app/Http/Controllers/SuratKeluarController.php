<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use App\Models\TujuanSurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
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

        if ($request->filled('jenis_surat_id')) {
            $query->where('jenis_surat_id', $request->jenis_surat_id);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('tujuan', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%');
            });
        }

        $suratKeluar = $query->latest()->paginate(10);

        $jenisSurat = JenisSurat::all();
        $tujuanSurat = TujuanSurat::all();

        return view('suratkeluar', compact('suratKeluar', 'jenisSurat', 'tujuanSurat'));
    }

    public function create()
    {
        $jenisSurat = JenisSurat::all();
        $tujuanSurat = TujuanSurat::all();
        return view('suratkeluar.create', compact('jenisSurat', 'tujuanSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'perihal' => 'required|string',
            'tujuan' => 'required|string',
            'alamat' => 'required|string',
            'isi_surat' => 'required|string',
            'status' => 'nullable|string|in:Draft,Dikirim,Disetujui,Ditolak',
        ]);

        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'jenis_surat_id' => $request->jenis_surat_id,
            'perihal' => $request->perihal,
            'tujuan' => $request->tujuan,
            'alamat' => $request->alamat,
            'isi_surat' => $request->isi_surat,
            'status' => $request->status ?? 'Draft',
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil disimpan.');
    }

    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('suratkeluar.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $jenisSurat = JenisSurat::all();
        $tujuanSurat = TujuanSurat::all();
        return view('suratkeluar.edit', compact('surat', 'jenisSurat', 'tujuanSurat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $request->validate([
            'tanggal_surat' => 'required|date',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'perihal' => 'required|string',
            'tujuan' => 'required|string',
            'alamat' => 'required|string',
            'isi_surat' => 'required|string',
            'status' => 'required|string|in:Draft,Dikirim,Disetujui,Ditolak',
        ]);

        $surat->update([
            'tanggal_surat' => $request->tanggal_surat,
            'jenis_surat_id' => $request->jenis_surat_id,
            'perihal' => $request->perihal,
            'tujuan' => $request->tujuan,
            'alamat' => $request->alamat,
            'isi_surat' => $request->isi_surat,
            'status' => $request->status ?? $surat->status,
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil dihapus.');
    }

    public function preview($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $pdf = Pdf::loadView('pdf.surat-keluar', compact('surat'));
        return $pdf->stream('surat-keluar.pdf');
    }

    
}
