<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input[cite: 2]
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek Role[cite: 2]
            if ($user->role == 'admin' || $user->role == 'petugas') {
                return redirect()->intended('/dashboard'); // Masuk ke panel admin[cite: 2]
            }

            return redirect()->intended('/'); // Pembeli balik ke landing page[cite: 1]
        }

        return back()->with('loginError', 'Username atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
