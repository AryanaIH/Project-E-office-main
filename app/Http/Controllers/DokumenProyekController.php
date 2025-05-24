<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenProyek;
use App\Models\JenisSurat;
use Illuminate\Support\Facades\Storage;

class DokumenProyekController extends Controller
{
    public function index()
    {
        $data = DokumenProyek::with('jenisSurat')->get();
        $jenisSurat = JenisSurat::all();
        return view('dokumen-proyek', compact('data', 'jenisSurat'));
    }

    public function edit($id)
    {
        $dokumen = DokumenProyek::findOrFail($id);
        $data = DokumenProyek::with('jenisSurat')->get();
        $jenisSurat = JenisSurat::all();
        return view('dokumen-proyek', compact('dokumen', 'data', 'jenisSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokumen' => 'required|unique:dokumen_proyek,id_dokumen',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'approval' => 'nullable|string',
            'template_dokumen' => 'nullable|file|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('template_dokumen')) {
            $path = $request->file('template_dokumen')->store('dokumen_templates');

            // Log untuk debugging
            \Log::info('File berhasil diunggah', [
                'original_name' => $request->file('template_dokumen')->getClientOriginalName(),
                'stored_path' => $path
            ]);
        } else {
            \Log::warning('Tidak ada file template_dokumen yang dikirim.');
        }

        DokumenProyek::create([
            'id_dokumen' => $request->id_dokumen,
            'jenis_surat_id' => $request->jenis_surat_id,
            'approval' => $request->approval,
            'template_dokumen' => $path,
        ]);

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenProyek::findOrFail($id);

        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'approval' => 'nullable|string',
            'template_dokumen' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('template_dokumen')) {
            // Hapus file lama jika ada
            if ($dokumen->template_dokumen) {
                Storage::delete($dokumen->template_dokumen);
            }

            $dokumen->template_dokumen = $request->file('template_dokumen')->store('dokumen_templates');

            \Log::info('File baru diunggah pada update', [
                'stored_path' => $dokumen->template_dokumen
            ]);
        }

        $dokumen->jenis_surat_id = $request->jenis_surat_id;
        $dokumen->approval = $request->approval;
        $dokumen->save();

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumen = DokumenProyek::findOrFail($id);

        // Hapus file template jika ada sebelum hapus data
        if ($dokumen->template_dokumen) {
            Storage::delete($dokumen->template_dokumen);
        }

        $dokumen->delete();

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil dihapus.');
    }
}
