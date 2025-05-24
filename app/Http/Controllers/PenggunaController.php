<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Departement;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data pengguna dan departemen
        $pengguna = Pengguna::all(); // ✅ Bukan Departement::all()
        $departements = Departement::all();
        $editData = null;

        // Jika sedang edit, ambil data pengguna berdasarkan ID
        if ($request->has('edit')) {
            $editData = Pengguna::findOrFail($request->edit); // ✅ Ambil dari MasterPengguna
        }

        return view('pengguna', compact('pengguna', 'departements', 'editData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengguna' => 'required|numeric|unique:master_penggunas,id_pengguna',
            'nama_pengguna' => 'required|string',
            'jabatan' => 'required|string',
            'hak_akses' => 'required|in:admin,user',
            'id_departement' => 'required|exists:departements,id',
            'nama_pengirim' => 'required|string',
        ]);

        Pengguna::create($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $validated = $request->validate([
            'id_pengguna' => 'required|numeric|unique:master_penggunas,id_pengguna,' . $pengguna->id,
            'nama_pengguna' => 'required|string',
            'jabatan' => 'required|string',
            'hak_akses' => 'required|in:admin,user',
            'id_departement' => 'required|exists:departements,id',
            'nama_pengirim' => 'required|string',
        ]);

        $pengguna->update($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
