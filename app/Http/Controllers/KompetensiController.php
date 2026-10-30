<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kompetensi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource (Admin).
     */
    public function index()
    {
        $kompetensis = Kompetensi::orderBy('nama_jurusan', 'asc')->paginate(10);
        
        $totalKompetensi = Kompetensi::count();
        $aktifKompetensi = Kompetensi::where('is_active', 1)->count();
        $nonaktifKompetensi = Kompetensi::where('is_active', 0)->count();
        
        return view('admin.kompetensi.index', compact(
            'kompetensis',
            'totalKompetensi',
            'aktifKompetensi',
            'nonaktifKompetensi'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kompetensi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
            'deskripsi' => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            // ✅ UBAH MAX 2048 JADI 10240 (10MB) AGAR BISA DIKOMPRES
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:10240',
        ]);

        $data = [
            'nama_jurusan' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
            'deskripsi' => $validatedData['deskripsi'],
            'prospek_karir' => $validatedData['prospek_karir'],
            'is_active' => $request->has('is_active') ? 1 : 0,
            'slug' => Str::slug($validatedData['nama']),
        ];

        // ✅ HANDLE UPLOAD ICON DENGAN KOMPRESI
        if ($request->hasFile('icon')) {
            $data['icon'] = $this->compressIcon($request->file('icon'));
        }

        Kompetensi::create($data);

        return redirect()->route('admin.kompetensi.index')
            ->with('success', 'Kompetensi keahlian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        return view('admin.kompetensi.edit', compact('kompetensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
            'deskripsi' => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            // ✅ UBAH MAX 2048 JADI 10240 (10MB) AGAR BISA DIKOMPRES
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:10240',
        ]);

        $data = [
            'nama_jurusan' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
            'deskripsi' => $validatedData['deskripsi'],
            'prospek_karir' => $validatedData['prospek_karir'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        // Auto update slug jika nama jurusan berubah
        if ($validatedData['nama'] !== $kompetensi->nama_jurusan) {
            $data['slug'] = Str::slug($validatedData['nama']);
        }

        // ✅ HANDLE UPLOAD ICON BARU DENGAN KOMPRESI
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($kompetensi->icon) {
                Storage::disk('public')->delete($kompetensi->icon);
            }
            $data['icon'] = $this->compressIcon($request->file('icon'));
        }

        $kompetensi->update($data);

        return redirect()->route('admin.kompetensi.index')
            ->with('success', 'Kompetensi keahlian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        
        if ($kompetensi->icon) {
            Storage::disk('public')->delete($kompetensi->icon);
        }
        
        $kompetensi->delete();

        return redirect()->route('admin.kompetensi.index')
            ->with('success', 'Kompetensi keahlian berhasil dihapus!');
    }

    // ==========================================
    // PUBLIC METHODS
    // ==========================================

    public function publicIndex()
    {
        $kompetensis = Kompetensi::where('is_active', 1)
            ->orderBy('nama_jurusan', 'asc')
            ->get();
        
        return view('portal.jurusan.index', compact('kompetensis'));
    }

    public function publicShow($slug)
    {
        $kompetensi = Kompetensi::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();
            
        return view('portal.jurusan.show', compact('kompetensi'));
    }

    // ==========================================
    // HELPER: ICON COMPRESSION
    // ==========================================

    /**
     * Fungsi Kompresi Icon/Gambar - Target < 2MB
     * Resize max 800px, kompresi bertahap sampai ukuran file < 2MB
     */
    private function compressIcon($file)
    {
        $maxSizeBytes = 2 * 1024 * 1024; // 2MB
        $tempPath = $file->getRealPath();
        
        $imageInfo = getimagesize($tempPath);
        if (!$imageInfo) {
            throw new \Exception('File bukan gambar valid.');
        }

        $mime = $imageInfo['mime'];
        
        // SVG tidak perlu kompresi, langsung simpan
        if ($mime == 'image/svg+xml') {
            $filename = 'icon_' . time() . '_' . uniqid() . '.svg';
            $path = 'kompetensi/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($tempPath));
            return $path;
        }
        
        // Buat resource gambar
        if ($mime == 'image/jpeg' || $mime == 'image/jpg') {
            $source = imagecreatefromjpeg($tempPath);
        } elseif ($mime == 'image/png') {
            $source = imagecreatefrompng($tempPath);
        } elseif ($mime == 'image/webp') {
            $source = imagecreatefromwebp($tempPath);
        } else {
            throw new \Exception('Format gambar tidak didukung.');
        }

        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        // Resize jika terlalu besar (max 800px untuk icon)
        if ($originalWidth > 800 || $originalHeight > 800) {
            $ratio = min(800 / $originalWidth, 800 / $originalHeight);
            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);
            
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency untuk PNG
            if ($mime == 'image/png') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            imagedestroy($source);
            $source = $resized;
        }

        // Kompresi bertahap sampai < 2MB
        $quality = 85;
        $tempFile = tempnam(sys_get_temp_dir(), 'compressed_icon');
        
        do {
            if ($mime == 'image/png') {
                $pngQuality = min(9, max(0, floor((100 - $quality) / 10)));
                imagepng($source, $tempFile, $pngQuality);
            } else {
                imagejpeg($source, $tempFile, $quality);
            }
            
            $fileSize = filesize($tempFile);
            
            // Break jika sudah <= 2MB atau kualitas sudah sangat rendah (10%)
            if ($fileSize <= $maxSizeBytes || $quality <= 10) {
                break;
            }
            
            $quality -= 5; // Turunkan kualitas 5% dan coba lagi
        } while (true);

        // Generate nama file
        $extension = ($mime == 'image/png') ? 'png' : 'jpg';
        $filename = 'icon_' . time() . '_' . uniqid() . '.' . $extension;
        $path = 'kompetensi/' . $filename;
        
        // Simpan ke storage Laravel
        Storage::disk('public')->put($path, file_get_contents($tempFile));
        
        // Cleanup memory & file temporary
        imagedestroy($source);
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
        
        return $path;
    }
}