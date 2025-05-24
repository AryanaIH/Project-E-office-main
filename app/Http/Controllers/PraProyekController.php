<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraProyek;

class PraProyekController extends Controller
{
    // Tampilkan semua pra-proyek
    public function index()
    {
        $praProyeks = PraProyek::latest()->paginate(10);
        return view('pra-proyek', compact('praProyeks'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('pra-proyek.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek'       => 'required|string|max:255',
            'klient'            => 'required|string|max:255',
            'lokasi'            => 'required|string|max:255',
            'jenis_proyek'      => 'required|in:master,konsultasi,pengembangan',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'status'            => 'required|in:draft,berjalan,lengkap',
        ]);

        PraProyek::create($request->all());

        return redirect()->route('pra-proyek.index')->with('success', 'Pra-proyek berhasil disimpan.');
    }

    // Tampilkan detail pra-proyek
    public function show($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek.show', compact('praProyek'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek.edit', compact('praProyek'));
    }

    // Update data pra-proyek
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek'       => 'required|string|max:255',
            'klient'            => 'required|string|max:255',
            'lokasi'            => 'required|string|max:255',
            'jenis_proyek'      => 'required|in:master,konsultasi,pengembangan',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'status'            => 'required|in:draft,berjalan,lengkap',
        ]);

        $praProyek = PraProyek::findOrFail($id);

        $praProyek->update([
            'nama_proyek'       => $request->nama_proyek,
            'klient'            => $request->klient,
            'lokasi'            => $request->lokasi,
            'jenis_proyek'      => $request->jenis_proyek,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'status'            => $request->status,
        ]);

        return redirect()->route('pra-proyek.index')->with('success', 'Pra-proyek berhasil diperbarui.');
    }

    // Hapus pra-proyek
    public function destroy($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        $praProyek->delete();

        return redirect()->route('pra-proyek.index')->with('success', 'Pra-proyek berhasil dihapus.');
    }
}
