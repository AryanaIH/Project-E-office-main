<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSurat;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $data = JenisSurat::all();
        $editData = null;

        if ($request->has('edit')) {
            $editData = JenisSurat::find($request->edit);
        }

        return view('jenis-surat', compact('data', 'editData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_surat' => 'required|unique:jenis_surat,id_jenis_surat',
            'nama_jenis_surat' => 'required'
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('jenis-surat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Redirect ke index dengan query string ?edit=id
        return redirect()->route('jenis-surat.index', ['edit' => $id]);
    }

    public function update(Request $request, $id)
    {
        $jenis = JenisSurat::findOrFail($id);

        $request->validate([
            'nama_jenis_surat' => 'required'
        ]);

        $jenis->update([
            'nama_jenis_surat' => $request->nama_jenis_surat
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $jenis = JenisSurat::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
