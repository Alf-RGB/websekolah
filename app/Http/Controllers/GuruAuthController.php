<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;

class GuruAuthController extends Controller
{
    /**
     * Tampilkan halaman login guru
     */
    public function showLogin()
    {
        // Jika sudah login, langsung ke dashboard
        if (Auth::guard('guru')->check()) {
            return redirect()->route('portal.guru.dashboard');
        }

        return view('auth.guru-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah guru ada dengan username tersebut
        $guru = Guru::where('username', $request->username)->first();

        // ✅ CEK 1: Guru tidak ditemukan
        if (!$guru) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan.',
            ])->withInput();
        }

        // ✅ CEK 2: Guru dinonaktifkan
        if ($guru->is_active == 0) {
            return back()->withErrors([
                'username' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.',
            ])->withInput();
        }

        // ✅ CEK 3: Password salah
        if (!Hash::check($request->password, $guru->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ])->withInput();
        }

        // ✅ LOGIN BERHASIL
        auth()->guard('guru')->login($guru, $request->has('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('portal.guru.dashboard'))
            ->with('success', 'Selamat datang, ' . $guru->nama . '!');
    }

    /**
     * Dashboard guru (setelah login)
     */
    public function dashboard()
    {
        $guru = Auth::guard('guru')->user();
        return view('portal.guru.dashboard', compact('guru'));
    }

    /**
     * Update profil guru
     */
    public function updateProfile(Request $request)
    {
        $guru = Auth::guard('guru')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'mata_pelajaran' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
        ]);

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'mata_pelajaran' => $request->mata_pelajaran,
            'pendidikan' => $request->pendidikan,
        ]);

        return redirect()->route('portal.guru.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

        /**
         * Logout guru
         */
        public function logout(Request $request)
        {
            \Illuminate\Support\Facades\Auth::guard('guru')->logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('portal.guru.login')->with('success', 'Anda berhasil logout.');
        }
}