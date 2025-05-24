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

    $path = $request->file('template_dokumen')?->store('dokumen_templates');

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
        if ($dokumen->template_dokumen) {
            Storage::delete($dokumen->template_dokumen);
        }
        $dokumen->template_dokumen = $request->file('template_dokumen')->store('dokumen_templates');
    }

    $dokumen->jenis_surat_id = $request->jenis_surat_id;
    $dokumen->approval = $request->approval;
    $dokumen->save();

    return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil diperbarui.');
}
 public function destroy($id)
    {
        DokumenProyek::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Departement berhasil dihapus');
    }

}
