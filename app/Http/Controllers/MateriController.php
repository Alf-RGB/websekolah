<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // <-- TAMBAHKAN INI
use App\Models\Materi;

class MateriController extends Controller
{
    // 1. Tampilkan daftar materi milik guru yang sedang login
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $materis = Materi::where('guru_id', $guru->id)->latest()->get();
        return view('portal.materi.index', compact('materis'));
    }

    // 2. Tampilkan form upload
    public function create()
    {
        return view('portal.materi.create');
    }

    // 3. Proses upload PDF
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Pastikan folder 'materis' ada di public (mencegah error jika folder terhapus)
        if (!file_exists(public_path('materis'))) {
            mkdir(public_path('materis'), 0755, true);
        }
        
        $file->move(public_path('materis'), $filename);

        Materi::create([
            'guru_id' => Auth::guard('guru')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filename,
        ]);

        return redirect('/portal/guru/materi')->with('success', 'Materi berhasil diupload!');
    }

    // 4. Hapus materi
    public function destroy($id)
    {
        // KEAMANAN: Pastikan materi ini benar-benar milik guru yang sedang login
        $materi = Materi::where('id', $id)
                        ->where('guru_id', Auth::guard('guru')->id())
                        ->firstOrFail();
        
        // PERBAIKAN: Pakai File::delete() agar lebih aman dari error jika file sudah terhapus
        if ($materi->file_path) {
            File::delete(public_path('materis/' . $materi->file_path));
        }
        
        $materi->delete();
        
        return redirect('/portal/guru/materi')->with('success', 'Materi berhasil dihapus!');
    }
}