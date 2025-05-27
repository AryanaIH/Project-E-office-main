<?php

namespace App\Http\Controllers;

use App\Models\master_proyek;
use Illuminate\Http\Request;

class MasterProyekController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $data = master_proyek::all();
        return view('masterProyek', compact('data'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_proyek' => 'required|numeric|unique:master_proyeks,id_proyek',
            'nama_proyek' => 'required|string',
            'client' => 'required|string',
            'lokasi_proyek' => 'required|string',
            'jenis_proyek' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status_proyek' => 'required|string',
        ]);

        master_proyek::create($request->all());

        return redirect()->route('master-proyek.index')->with('success', 'Data berhasil disimpan!');
    }

    // Menampilkan data untuk diedit
    public function edit($id)
    {
        $editData = master_proyek::findOrFail($id); // data yang akan diedit
        $data = master_proyek::all(); // semua data untuk tabel
        return view('masterProyek', compact('editData', 'data'));
    }

    // Update data yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek' => 'required|string',
            'client' => 'required|string',
            'lokasi_proyek' => 'required|string',
            'jenis_proyek' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status_proyek' => 'required|string',
        ]);

        $proyek = master_proyek::findOrFail($id);
        $proyek->update($request->all());

        return redirect()->route('master-proyek.index')->with('success', 'Data berhasil diupdate!');
    }

    // Hapus data
    public function destroy($id)
    {
        $proyek = master_proyek::findOrFail($id);
        $proyek->delete();

        return redirect()->route('master-proyek.index')->with('success', 'Data berhasil dihapus!');
    }
}
