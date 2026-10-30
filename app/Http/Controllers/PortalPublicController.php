<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Setting;
use App\Models\Materi;

class PortalPublicController extends Controller
{
    /**
     * Tampilkan daftar guru di portal akademik
     */
    public function daftarGuru()
    {
        // ✅ HANYA TAMPILKAN GURU YANG STATUSNYA AKTIF (is_active = 1)
        $gurus = Guru::where('is_active', 1)
            ->orderBy('nama', 'asc')
            ->get();
        
        $data = [
            'nama_sekolah' => Setting::where('key', 'nama_sekolah')->value('value') ?? 'SMK Multi Karya Medan'
        ];
        
        return view('public.portal.daftar-guru', compact('gurus', 'data'));
    }

    /**
     * Download materi ajar
     */
    public function downloadMateri($id)
    {
        $materi = Materi::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $materi->file);
        
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        
        return back()->with('error', 'File materi tidak ditemukan.');
    }

    /**
     * Detail profil guru (Hanya untuk guru yang sudah login)
     */
    public function detailGuru($id)
    {
        // Cek apakah user sudah login sebagai guru
        if (!auth()->guard('guru')->check()) {
            return redirect()->route('portal.login', ['redirect' => url()->current()]);
        }

        // ✅ HANYA TAMPILKAN GURU YANG AKTIF
        $guru = Guru::where('is_active', 1)->findOrFail($id);
        
        return view('public.portal.daftar-guru', compact('gurus', 'data'));
    }
}