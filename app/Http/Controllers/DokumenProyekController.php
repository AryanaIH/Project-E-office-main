<?php

namespace App\Http\Controllers;

use App\Models\PraProyek;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\DokumenProyek;
use App\Models\JenisSurat;
use Illuminate\Support\Facades\Storage;

class DokumenProyekController extends Controller
{
    public function index()
    {
        $data = DokumenProyek::with('jenisSurat')->get();
        $jenisSurat = JenisSurat::all();
        $id_proyeks = PraProyek::all();
        return view('dokumen-proyek', compact('data', 'jenisSurat','id_proyeks'));
    }

    public function edit($id)
    {
        $dokumen = DokumenProyek::findOrFail($id);
        $data = DokumenProyek::with('jenisSurat')->get();
        $jenisSurat = JenisSurat::all();
        return view('dokumen-proyek', compact('dokumen', 'data', 'jenisSurat'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_dokumen' => 'required|unique:dokumen_proyeks,id_dokumen',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'approval' => 'required|string',
            'template_dokumen' => 'required|file|mimes:pdf|max:2048',
        ]);

        $templatePath = null;

        if ($request->hasFile('template_dokumen')) {
            $file = $request->file('template_dokumen');
            $templatePath = $file->hashName();
            $file->move('templates', $templatePath);
        }

        DokumenProyek::create([
            'id_dokumen' => $request->id_dokumen,
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_file' => $templatePath,
            'approval' => $request->approval,
            'id_proyeks'=> $request->proyeks_id,
            'template_dokumen' => $templatePath,
        ]);

        return redirect()->route('dokumen-proyek.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $dokumen = DokumenProyek::where('id_dokumen', $id)->firstOrFail();

        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_file' => 'required|string',
            'approval' => 'nullable|string',
            'template_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $templatePath = $dokumen->template_dokumen;

        if ($request->hasFile('template_dokumen')) {
            if ($templatePath && Storage::exists('public/' . $templatePath)) {
                Storage::delete('public/' . $templatePath);
            }

            $file = $request->file('template_dokumen');
            $file->storeAs('public/templates', $file->hashName());
            $templatePath = 'templates/' . $file->hashName();
        }

        $dokumen->update([
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_file' => $request->nama_file,
            'approval' => $request->approval,
            'template_dokumen' => $templatePath,
        ]);

        return redirect()->route('dokumen-proyek.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $dokumen = DokumenProyek::findOrFail($id);

        if ($dokumen->template_dokumen && file_exists('templates/' . $dokumen->template_dokumen)) {
            unlink('templates/' . $dokumen->template_dokumen);
        }

        $dokumen->delete();

        return redirect()->route('dokumen-proyek.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
