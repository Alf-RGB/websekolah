<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftar::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%") // ✅ DIPERBAIKI: dari 'nama' jadi 'nama_lengkap'
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('kode_tracking', 'like', "%{$search}%");
            });
        }

        $pendaftars = $query->orderBy('created_at', 'desc')->paginate(12);

        $totalPendaftar = Pendaftar::count();
        $diterimaPendaftar = Pendaftar::where('status', 'diterima')->count();
        $menungguPendaftar = Pendaftar::where('status', 'menunggu')->count(); 
        $ditolakPendaftar = Pendaftar::where('status', 'ditolak')->count();

        return view('admin.pendaftar.index', compact(
            'pendaftars',
            'totalPendaftar',
            'diterimaPendaftar',
            'menungguPendaftar',
            'ditolakPendaftar'
        ));
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('admin.pendaftar.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak', 
        ]);

        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $validated['status'];
        $pendaftar->save();

        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui menjadi: ' . ucfirst($validated['status']));
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('admin.pendaftar.index')->with('success', 'Data pendaftar berhasil dihapus!');
    }


    public function publicForm()
    {
        $settings = \App\Models\Setting::pluck('value', 'key');
        return view('public.ppdb.index', compact('settings'));
    }

    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nisn'           => 'required|string|max:20',
            'asal_sekolah'   => 'required|string|max:255',
            'alamat'         => 'required|string',
            'no_hp'          => 'required|string|max:20',
            'nama_ortu'      => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255', 
            'alasan'         => 'nullable|string',
        ]);

        $kode_tracking = 'PPDB-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

        $data = $validated;
        $data['kode_tracking'] = $kode_tracking;
        $data['status'] = 'menunggu'; // Default status saat mendaftar

        Pendaftar::create($data);

        return redirect('/')->with('success', 'Pendaftaran PPDB berhasil dikirim!')->with('tracking_code', $kode_tracking);
    }
}