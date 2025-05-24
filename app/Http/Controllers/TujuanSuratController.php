<?php

namespace App\Http\Controllers;

use App\Models\TujuanSurat;
use Illuminate\Http\Request;

class TujuanSuratController extends Controller
{
    public function index()
    {
        $tujuanSurat = TujuanSurat::all();
        return view('tujuan-surat', compact('tujuanSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tujuan' => 'required|unique:tujuan_surat,id_tujuan',
            'nama_penerima' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        TujuanSurat::create($request->all());

        return redirect()->back()->with('success', 'Data tujuan surat berhasil disimpan.');
    }

    public function edit($id)
    {
        $tujuanEdit = TujuanSurat::findOrFail($id);
        $tujuanSurat = TujuanSurat::all();

        return view('tujuan-surat', [
            'editMode' => true,
            'tujuanEdit' => $tujuanEdit,
            'tujuanSurat' => $tujuanSurat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $tujuan = TujuanSurat::findOrFail($id);

        $request->validate([
            'nama_penerima' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        $tujuan->update($request->all());

        return redirect()->route('tujuan-surat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id_tujuan)
    {
        $tujuan = TujuanSurat::where('id_tujuan', $id_tujuan)->firstOrFail();
        $tujuan->delete();
        
        return redirect()->route('tujuan-surat.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $tujuan = TujuanSurat::findOrFail($id);
        return view('detail-tujuan-surat', compact('tujuan'));
    }
}
