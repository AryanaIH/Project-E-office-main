<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::all();
        return view('departemen', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:departements,kode',
            'nama' => 'required'
        ]);

        Departement::create($request->only('kode', 'nama'));

        return redirect()->back()->with('success', 'Departement berhasil disimpan');
    }

    public function destroy($id)
    {
        Departement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Departement berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required'
        ]);

        $dept = Departement::findOrFail($id);
        $dept->update($request->only('kode', 'nama'));

        return redirect()->back()->with('success', 'Departement berhasil diupdate');
    }

    public function edit($id)
    {
        $departement = Departement::findOrFail($id);
        $departements = Departement::all();
        return view('departemen', compact('departement', 'departements'));
    }
}
