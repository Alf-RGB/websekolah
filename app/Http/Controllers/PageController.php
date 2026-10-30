<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // WAJIB ADA
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        
        // 1. Validasi
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'is_published' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:10240', // Max 10MB (akan dikompres)
        ]);

        // 2. Handle Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($page->foto && Storage::disk('public')->exists($page->foto)) {
                Storage::disk('public')->delete($page->foto);
            }
            // Kompres dan simpan foto baru
            $validated['foto'] = $this->compressAndSaveImage($request->file('foto'));
            
        } elseif ($request->input('remove_photo') == '1') {
            // Hapus foto jika user klik tombol hapus
            if ($page->foto && Storage::disk('public')->exists($page->foto)) {
                Storage::disk('public')->delete($page->foto);
            }
            $validated['foto'] = null;
        }

        // 3. Handle Status Publish (Jika tidak dicentang, nilainya 0)
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        // 4. Update ke Database
        $page->update($validated);

        return redirect()->route('admin.pages.index')
    ->with('success', "Halaman <strong>{$page->judul}</strong> berhasil diperbarui dan foto telah dikompres!");
    }

    /**
     * Fungsi Kompresi Gambar Native PHP (Tanpa Package, 100% Works)
     */
    private function compressAndSaveImage($file)
    {
        $maxSizeBytes = 2 * 1024 * 1024; // Target 2MB
        $tempPath = $file->getRealPath();
        $imageInfo = getimagesize($tempPath);
        
        if (!$imageInfo) throw new \Exception('File bukan gambar valid.');

        $mime = $imageInfo['mime'];
        if ($mime == 'image/jpeg' || $mime == 'image/jpg') {
            $source = imagecreatefromjpeg($tempPath);
        } elseif ($mime == 'image/png') {
            $source = imagecreatefrompng($tempPath);
        } else {
            throw new \Exception('Format tidak didukung. Gunakan JPG/PNG.');
        }

        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        // Resize jika > 1200px
        if ($originalWidth > 1200) {
            $ratio = 1200 / $originalWidth;
            $newWidth = 1200;
            $newHeight = (int)($originalHeight * $ratio);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            imagedestroy($source);
            $source = $resized;
        }

        // Kompresi bertahap sampai < 2MB
        $quality = 85;
        $tempFile = tempnam(sys_get_temp_dir(), 'img_compress');
        
        do {
            imagejpeg($source, $tempFile, $quality);
            $fileSize = filesize($tempFile);
            if ($fileSize <= $maxSizeBytes || $quality <= 10) break;
            $quality -= 5;
        } while (true);

        $filename = 'foto_' . time() . '_' . uniqid() . '.jpg';
        $path = 'pages/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($tempFile));
        
        imagedestroy($source);
        unlink($tempFile);
        
        return $path;
    }

    public function publicProfil()
    {
        $sambutan = Page::where('slug', 'sambutan-kepala-sekolah')->where('is_published', 1)->first();
        $visiMisi = Page::where('slug', 'visi-dan-misi')->where('is_published', 1)->first();
        $sejarah = Page::where('slug', 'sejarah-sekolah')->where('is_published', 1)->first();

        return view('public.pages.profil', compact('sambutan', 'visiMisi', 'sejarah'));
    }
    
    public function publicShow($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', 1)->firstOrFail();
        return view('public.pages.show', compact('page'));
    }
}