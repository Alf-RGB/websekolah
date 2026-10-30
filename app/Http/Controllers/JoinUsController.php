<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LamaranGuru;
use App\Models\Pendaftar; // Ditambahkan agar tidak perlu pakai \App\Models\ di bawah

class JoinUsController extends Controller
{
    // ==========================================
    // HALAMAN PUBLIK (JOIN US)
    // ==========================================

    public function index()
    {
        return view('public.join-us.index');
    }

    public function redirectSiswa()
    {
        return redirect('/ppdb');
    }

    public function formGuru()
    {
        return view('public.join-us.form-guru');
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'mata_pelajaran_diinginkan' => 'required|string|max:255',
            'pengalaman_mengajar' => 'nullable|string',
            'alasan_melamar' => 'required|string',
            'file_cv' => 'nullable|file|mimes:pdf|max:2048', // Max 2MB
        ]);

        $data = $request->except('file_cv');
        $data['status'] = 'pending';
        
        // Map field form ke kolom database
        $data['mata_pelajaran'] = $request->mata_pelajaran_diinginkan;

        // Generate Kode Tracking Otomatis (Contoh: TRK-G-20260715-A3F2)
        $kode_tracking = 'TRK-G-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $data['kode_tracking'] = $kode_tracking;

        // Upload CV jika ada
        if ($request->hasFile('file_cv')) {
            $file = $request->file('file_cv');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Pastikan folder 'lamaran' ada di public (mencegah error jika folder terhapus)
            if (!file_exists(public_path('lamaran'))) {
                mkdir(public_path('lamaran'), 0755, true);
            }
            
            $file->move(public_path('lamaran'), $filename);
            $data['file_cv'] = $filename;
        }

        LamaranGuru::create($data);

        return redirect('/join-us')
            ->with('success', 'Lamaran Anda berhasil dikirim!')
            ->with('tracking_code', $kode_tracking);
    }

    // ==========================================
    // CEK STATUS LAMARAN
    // ==========================================

    public function showCekStatusForm()
    {
        return view('public.ppdb.cek-status');
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'kode_tracking' => 'required|string',
            'tipe' => 'required|in:guru,siswa',
        ]);

        $result = null;
        $error = null;

        if ($request->tipe === 'guru') {
            $result = LamaranGuru::where('kode_tracking', $request->kode_tracking)->first();
        } else {
            $result = Pendaftar::where('kode_tracking', $request->kode_tracking)->first();
        }

        if (!$result) {
            $error = 'Kode tracking tidak ditemukan. Silakan periksa kembali.';
        }

        // Kembali ke halaman Join Us dengan membawa hasil atau error
        return view('public.join-us.index', compact('result', 'error'));
    }
}