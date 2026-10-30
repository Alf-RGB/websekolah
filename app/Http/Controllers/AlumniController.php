<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller
{
    public function adminIndex()
    {
        $alumnis = Alumni::orderBy('created_at', 'desc')->get();
        return view('admin.alumni.index', compact('alumnis'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:alumnis,email',
            'password' => 'required|string|min:8|confirmed',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'jurusan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('alumni', $filename, 'public');
            $data['foto'] = $filename;
        }

        Alumni::create($data);

        return redirect('/admin/alumni')->with('success', 'Alumni berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:alumnis,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'jurusan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('password');
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        
        if ($request->hasFile('foto')) {
            if ($alumni->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('alumni/' . $alumni->foto);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('alumni', $filename, 'public');
            $data['foto'] = $filename;
        }

        $alumni->update($data);

        return redirect('/admin/alumni')->with('success', 'Alumni berhasil diperbarui!');
    }

    public function toggleFeatured($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->is_featured = !$alumni->is_featured;
        $alumni->save();

        return redirect('/admin/alumni')->with('success', 'Status featured berhasil diubah!');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        
        if ($alumni->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('alumni/' . $alumni->foto);
        }
        
        $alumni->delete();

        return redirect('/admin/alumni')->with('success', 'Alumni berhasil dihapus!');
    }

    public function publicIndex()
    {
        $alumnis = Alumni::orderBy('angkatan', 'desc')
            ->paginate(20);
            
        return view('public.alumni.index', compact('alumnis'));
    }
    

    public function publicForm()
    {
        return view('public.alumni.form');
    }

    public function publicStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:alumnis,email',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'jurusan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'pesan' => 'nullable|string',
        ]);

        // Generate password random
        $password = \Illuminate\Support\Str::random(8);

        Alumni::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'angkatan' => $request->angkatan,
            'jurusan' => $request->jurusan,
            'pekerjaan' => $request->pekerjaan,
            'perusahaan' => $request->perusahaan,
            'pesan' => $request->pesan,
            'is_active' => false, // Perlu approval admin
        ]);

        return redirect('/alumni')->with('success', 'Pendaftaran alumni berhasil! Mohon tunggu konfirmasi dari admin.');
    }
}