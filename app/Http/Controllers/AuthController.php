<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }
        return view('auth.login');
    }

    // Proses login dengan USERNAME
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba login pakai username & password
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'super_admin') {
                return redirect('/admin/dashboard')->with('success', 'Selamat datang, Super Admin!');
            }
            
            return redirect('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}