<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index(Request $request)
    {
        $akunList = User::orderBy('id')->get();
        $editData = null;

        if ($request->has('edit')) {
            $editData = User::findOrFail($request->edit);
        }

        return view('pengaturan', compact('akunList', 'editData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'level' => 'required|in:admin,operator',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'level'    => $request->level,
            'password' => Hash::make('password123') // default password
        ]);

        return redirect()->route('pengaturan')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $akun = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $akun->id,
            'level' => 'required|in:admin,operator',
        ]);

        $akun->update([
            'name'  => $request->name,
            'email' => $request->email,
            'level' => $request->level
        ]);

        return redirect()->route('pengaturan')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akun = User::findOrFail($id);
        $akun->delete();

        return redirect()->route('pengaturan')->with('success', 'Akun berhasil dihapus.');
    }
}
