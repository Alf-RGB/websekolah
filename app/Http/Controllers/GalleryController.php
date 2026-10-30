<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Tampilkan daftar galeri
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $galleries = $query->orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);

        $totalGalleries = Gallery::count();
        $aktifGalleries = Gallery::where('is_active', 1)->count();
        $nonaktifGalleries = Gallery::where('is_active', 0)->count();

        return view('admin.galleries.index', compact(
            'galleries', 
            'totalGalleries', 
            'aktifGalleries', 
            'nonaktifGalleries'
        ));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * FUNGSI AUTO KOMPRES GAMBAR
     * Resize max 800px & kompres ke JPEG 80%
     */
    private function compressImage($sourcePath, $destinationPath, $maxWidth = 800, $quality = 80)
    {
        $imageInfo = getimagesize($sourcePath);
        $mime = $imageInfo['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        $originalWidth = imagesx($image);
        $originalHeight = imagesy($image);

        // Resize jika lebih besar dari maxWidth
        if ($originalWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = intval($originalHeight * ($maxWidth / $originalWidth));
            
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency untuk PNG
            if ($mime === 'image/png') {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
                imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            imagedestroy($image);
            $image = $newImage;
        }

        // Simpan sebagai JPEG (kompres lebih baik)
        imagejpeg($image, $destinationPath, $quality);
        imagedestroy($image);
        
        return true;
    }

        private function handleImageUpload($request)
    {
        if (!$request->hasFile('gambar')) {
            return null; 
        }

        $file = $request->file('gambar');
        
        // Generate nama file unik
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.jpg';
        
        // Pastikan folder galleries ada
        if (!Storage::disk('public')->exists('galleries')) {
            Storage::disk('public')->makeDirectory('galleries');
        }

        $destinationPath = storage_path('app/public/galleries/' . $filename);
        $tempPath = $file->getRealPath();

        // Kompres & simpan
        $this->compressImage($tempPath, $destinationPath, 800, 80);

        // ✅ PASTIKAN RETURN NYA HANYA 'galleries/namafile.jpg'
        return 'galleries/' . $filename;
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
        ], [
            'gambar.required' => 'File gambar WAJIB diupload saat membuat galeri baru!',
            'gambar.image' => 'File yang diupload harus berupa gambar!',
            'gambar.mimes' => 'Format gambar harus JPG, PNG, atau WEBP!',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'kategori']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        
        // ✅ AUTO GENERATE SLUG DARI JUDUL
        $data['slug'] = Str::slug($request->judul);
        
        // Handle upload dengan auto kompres
        $data['gambar'] = $this->handleImageUpload($request);

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil ditambahkan dan dikompres otomatis!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
                'is_active' => 'nullable|boolean',
            ], [
                'judul.required' => 'Judul foto harus diisi!',
                'kategori.required' => 'Kategori harus dipilih!',
                'gambar.image' => 'File harus berupa gambar!',
                'gambar.mimes' => 'Format gambar harus JPG, PNG, atau WEBP!',
            ]);

            $data = $validatedData;
            
            // ✅ UPDATE SLUG JIKA JUDUL BERUBAH
            if ($request->judul !== $gallery->judul) {
                $data['slug'] = Str::slug($request->judul);
            }
            
            // Handle is_active
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            // Handle upload dengan auto kompres
            $data['gambar'] = $this->handleImageUpload($request, $gallery->gambar);

            $gallery->update($data);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Foto berhasil diperbarui!' . ($request->hasFile('gambar') ? ' Gambar juga berhasil dikompres & diupload!' : ''));
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus galeri
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if ($gallery->gambar) {
            Storage::disk('public')->delete($gallery->gambar);
        }
        
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil dihapus!');
    }

    public function publicGallery(Request $request)
    {
        $query = Gallery::where('is_active', 1); // Hanya tampilkan yang aktif
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $kategori = $request->kategori;
            
            // Handle kategori "Semua"
            if (strtolower($kategori) !== 'semua') {
                $query->where('kategori', $kategori);
            }
        }
        
        // Urutkan berdasarkan created_at terbaru
        $galleries = $query->orderBy('created_at', 'desc')->paginate(12);
        
        return view('public.galeri.index', compact('galleries'));
    }

    public function publicShow($slug)
    {
        $gallery = Gallery::where('slug', $slug)
                          ->where('is_active', 1)
                          ->firstOrFail();
        return view('public.galeri.show', compact('gallery'));
    }
}