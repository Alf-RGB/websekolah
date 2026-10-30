<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LamaranGuru;

class LamaranGuruController extends Controller
{
    public function index(Request $request)
    {
        $query = LamaranGuru::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('mata_pelajaran', 'like', "%{$search}%");
        }
        
        $lamarans = $query->latest()->paginate(10);
        
        return view('admin.lamaran.index', [
            'lamarans' => $lamarans,
            'totalLamaran' => LamaranGuru::count(),
            'pendingLamaran' => LamaranGuru::where('status', 'pending')->count(),
            'acceptedLamaran' => LamaranGuru::where('status', 'diterima')->count(),
            'rejectedLamaran' => LamaranGuru::where('status', 'ditolak')->count(),
        ]);
    }

    public function showDetail($id)
    {
        $lamaran = LamaranGuru::findOrFail($id);
        return view('admin.lamaran.detail', compact('lamaran'));
    }

    public function update(Request $request, $id)
    {
        $lamaran = LamaranGuru::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $lamaran->status = $request->status;
        $lamaran->save();

        return redirect('/admin/lamaran')->with('success', 'Status lamaran berhasil diperbarui!');
    }

    public function destroy($id)
        {
            $lamaran = LamaranGuru::findOrFail($id);
            $lamaran->delete();

            return redirect('/admin/lamaran')->with('success', 'Lamaran berhasil dihapus!');
        }
        
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $lamaran = LamaranGuru::findOrFail($id);
        $lamaran->status = $request->status;
        $lamaran->save();

        return redirect()->route('admin.lamaran.index')
            ->with('success', 'Status lamaran berhasil diubah menjadi "' . ucfirst($request->status) . '"!');
    }
}