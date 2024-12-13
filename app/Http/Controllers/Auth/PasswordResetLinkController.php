<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.passwords.email'); // Ganti dengan tampilan yang sesuai
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirim link reset password
        Password::sendResetLink($request->only('email'));

        return back()->with('status', 'Password reset link sent!');
    }
}
