<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Menampilkan halaman login
    public function create()
    {
        return view('auth.login'); // Pastikan ini sesuai dengan tampilan login Anda
    }

    // Proses login
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect ke dashboard admin setelah login
            return redirect()->intended('/admin'); // Rute dashboard Filament
        }

        // Jika gagal, kembali dengan pesan kesalahan
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email')); // Mengisi kembali email yang dimasukkan
    }

    // Proses logout
    public function destroy()
    {
        Auth::logout(); // Logout pengguna
        return redirect('/admin/login'); // Rute login Anda
    }
}
