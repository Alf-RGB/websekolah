<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('mata_pelajaran', 'like', "%{$search}%");
            });
        }

        // ✅ PENTING: LOAD RELASI USER
        $gurus = $query->orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);
        
        $totalGuru = Guru::count();
        $aktifGuru = Guru::where('is_active', 1)->count();
        $nonaktifGuru = Guru::where('is_active', 0)->count();

        return view('admin.guru.index', compact(
            'gurus', 
            'totalGuru', 
            'aktifGuru', 
            'nonaktifGuru'
        ));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('gurus', 'username')],
            'password' => 'required|string|min:6|confirmed',
            'mata_pelajaran' => 'nullable|string|max:255',
        ], [
            'username.regex' => 'Username hanya boleh huruf, angka, dan underscore (_).',
            'username.unique' => 'Username ini sudah digunakan.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        Guru::create([
            'nama' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'mata_pelajaran' => $request->mata_pelajaran ?? 'Belum diisi',
            'is_active' => 1, // Default aktif saat dibuat
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Akun login guru berhasil dibuat!');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        
        $request->validate([
            'username' => 'nullable|string|min:4|max:20|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'nullable|string|min:6|confirmed',
            'is_active' => 'nullable|boolean',
        ], [
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, dan underscore (_).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        $data = ['nama' => $guru->nama];
        $updatedFields = [];

        // ✅ UPDATE USERNAME JIKA DIISI
        if ($request->filled('username')) {
            $existing = Guru::where('username', $request->username)
                            ->where('id', '!=', $id)
                            ->first();
            
            if ($existing) {
                return back()->with('error', 'Username sudah digunakan oleh guru lain!')->withInput();
            }
            
            $data['username'] = $request->username;
            $updatedFields[] = 'username';
        }

        // ✅ UPDATE PASSWORD JIKA DIISI
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $updatedFields[] = 'password';
        }

        // ✅ UPDATE STATUS AKTIF/NONAKTIF (LEBIH ROBUST)
        // Gunakan input() dengan default value 0 jika tidak ada
        if ($request->has('is_active')) {
            $data['is_active'] = (int)$request->input('is_active');
            $updatedFields[] = 'is_active';
        }

        $guru->update($data);

        // ✅ TENTUKAN PESAN SUKSES YANG SPESIFIK
        if (in_array('is_active', $updatedFields)) {
            $status = $request->input('is_active') ? 'diaktifkan' : 'dinonaktifkan';
            $message = "Status guru <strong>{$guru->nama}</strong> berhasil {$status}!";
        } elseif (in_array('password', $updatedFields) && in_array('username', $updatedFields)) {
            $message = "Username dan password guru <strong>{$guru->nama}</strong> berhasil diperbarui!";
        } elseif (in_array('password', $updatedFields)) {
            $message = "Password guru <strong>{$guru->nama}</strong> berhasil direset!";
        } elseif (in_array('username', $updatedFields)) {
            $message = "Username guru <strong>{$guru->nama}</strong> berhasil ditambahkan/diperbarui!";
        } else {
            $message = "Data guru <strong>{$guru->nama}</strong> berhasil diperbarui!";
        }

        return redirect()->route('admin.guru.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        
        if ($guru->foto) {
            Storage::disk('public')->delete('gurus/' . $guru->foto);
        }
        
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus!');
    }

    public function publicIndex()
    {
        // ✅ HANYA TAMPILKAN GURU YANG AKTIF DI HALAMAN PUBLIK
        $gurus = Guru::where('is_active', 1)->orderBy('nama', 'asc')->get();
        $data = [
            'nama_sekolah' => \App\Models\Setting::where('key', 'nama_sekolah')->value('value') ?? 'Sekolah'
        ];
        
        return view('public.guru.index', compact('gurus', 'data'));
    }
}