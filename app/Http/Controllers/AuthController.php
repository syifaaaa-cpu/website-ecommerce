<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        // 2. Persiapkan data login (menggunakan kolom 'username' di DB)
        $loginData = [
            'username' => $credentials['email'],
            'password' => $credentials['password']
        ];

        // 3. Coba autentikasi
        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();

            // 4. LOGIKA REDIRECT (Pemisah Admin & Pembeli)
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/katalog');
        }

        // 5. Jika gagal
        return back()->with('loginError', 'Username atau password salah!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = new User();
        $user->nama_user = $request->name;
        $user->username  = $request->email;
        $user->password  = Hash::make($request->password);
        $user->role      = 'pembeli';
        $user->save();

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
