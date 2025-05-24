<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $level = strtolower(trim($user->level)); // <-- gunakan kolom 'level'

            if ($level === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($level === 'operator') {
                return redirect()->intended('/operator/dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Level tidak dikenali');
            }
        }

        return back()->with('error', 'Nama pengguna atau kata sandi salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Form ubah password
    public function showChangePasswordForm()
    {
        return view('ubah-password');
    }

    // Proses ubah password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah'])->withInput();
        }

        // Update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('ubah-password.form')->with('success', 'Password berhasil diubah!');

    }
}
