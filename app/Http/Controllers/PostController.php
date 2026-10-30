<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Tampilkan daftar berita
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10)->onEachSide(1);

        $totalPosts = Post::count();
        $publishedPosts = Post::where('is_published', 1)->count();
        $draftPosts = Post::where('is_published', 0)->count();

        return view('admin.posts.index', compact('posts', 'totalPosts', 'publishedPosts', 'draftPosts'));
    }

    /**
     * Tampilkan form tambah berita
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Simpan berita baru (DENGAN AUTO KOMPRESI GAMBAR)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'konten' => 'required|string',
            // ✅ UBAH MAX 2048 JADI 10240 (10MB) AGAR BISA DIKOMPRES DULU
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', 
            'is_published' => 'nullable|boolean',
        ]);

        $data = $validatedData;
        $data['is_published'] = $request->has('is_published') ? 1 : 0;
        
        // Auto generate slug
        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // ✅ HANDLE UPLOAD GAMBAR DENGAN KOMPRESI
        if ($request->hasFile('image')) {
            $data['image'] = $this->compressAndSaveImage($request->file('image'));
        }

        // Set published_at jika langsung dipublikasikan
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil ditambahkan! Gambar otomatis dikompres.');
    }

    /**
     * Tampilkan form edit berita
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update berita (DENGAN AUTO KOMPRESI GAMBAR BARU)
     */
    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
                'konten' => 'nullable|string',
                // ✅ UBAH MAX 2048 JADI 10240 (10MB) AGAR BISA DIKOMPRES DULU
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
                'is_published' => 'nullable|boolean',
            ], [
                'judul.required' => 'Judul berita harus diisi!',
                'kategori.required' => 'Kategori harus dipilih!',
                'image.image' => 'File harus berupa gambar!',
            ]);

            $data = $validatedData;
            
            // Update slug jika judul berubah
            if ($request->judul !== $post->judul) {
                $slug = Str::slug($request->judul);
                $originalSlug = $slug;
                $counter = 1;
                
                while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $data['slug'] = $slug;
            }
            
            // Handle published_at
            if ($request->has('is_published') && $request->is_published) {
                $data['is_published'] = true;
                if (!$post->is_published || is_null($post->published_at)) {
                    $data['published_at'] = now();
                }
            } else {
                $data['is_published'] = false;
                $data['published_at'] = null;
            }

            // ✅ HANDLE UPLOAD GAMBAR BARU DENGAN KOMPRESI
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $data['image'] = $this->compressAndSaveImage($request->file('image'));
            }

            $post->update($data);

            $successMsg = 'Berita berhasil diperbarui!';
            if ($request->hasFile('image')) {
                $successMsg .= ' Gambar baru berhasil dikompres & diupload!';
            }

            return redirect()->route('admin.posts.index')->with('success', $successMsg);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus berita
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus!');
    }

    // ==========================================
    // PUBLIC METHODS
    // ==========================================

    public function publicNews()
    {
        $posts = Post::where('is_published', 1)
                     ->orderBy('published_at', 'desc')
                     ->paginate(10);
        
        return view('public.berita.index', compact('posts'));
    }

    public function publicShow($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();
        return view('public.berita.show', compact('post'));
    }

    // ==========================================
    // HELPER: IMAGE COMPRESSION
    // ==========================================

    /**
     * Fungsi Kompresi Gambar - Target < 2MB
     * Resize max 1200px, kompresi bertahap sampai ukuran file < 2MB
     */
    private function compressAndSaveImage($file)
    {
        $maxSizeBytes = 2 * 1024 * 1024; // 2MB
        $tempPath = $file->getRealPath();
        
        $imageInfo = getimagesize($tempPath);
        if (!$imageInfo) {
            throw new \Exception('File bukan gambar valid.');
        }

        $mime = $imageInfo['mime'];
        
        // Buat resource gambar berdasarkan tipe
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

        // Resize jika dimensi > 1200px (agar proporsional)
        if ($originalWidth > 1200 || $originalHeight > 1200) {
            $ratio = min(1200 / $originalWidth, 1200 / $originalHeight);
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

        // Kompresi bertahap sampai ukuran file < 2MB
        $quality = 85; // Mulai dari kualitas 85%
        $tempFile = tempnam(sys_get_temp_dir(), 'compressed_img');
        
        do {
            if ($mime == 'image/png') {
                // PNG compression level: 0 (no compression) to 9 (max compression)
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

        // Generate nama file unik
        $extension = ($mime == 'image/png') ? 'png' : 'jpg';
        $filename = 'thumbnail_' . time() . '_' . uniqid() . '.' . $extension;
        $path = 'posts/' . $filename;
        
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