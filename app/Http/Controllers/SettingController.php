<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // ==========================================
    // HALAMAN PUBLIK (Beranda)
    // ==========================================
    public function publicHome()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $data = [
            'nama_sekolah' => $settings['nama_sekolah'] ?? 'Sekolah Kita',
            'telepon_sekolah' => $settings['telepon_sekolah'] ?? '6281234567890',
        ];

        $heroGalleries = Gallery::where('is_active', true)->latest()->take(3)->get();
        $sambutan = Page::where('slug', 'sambutan-kepala-sekolah')->first();
        $latestPosts = Post::latest()->take(6)->get();
        $latestGalleries = Gallery::where('is_active', true)->latest()->take(6)->get();
        $previewGurus = Guru::latest()->take(4)->get();

        return view('public.home', compact(
            'data',
            'heroGalleries',
            'sambutan',
            'latestPosts',
            'latestGalleries',
            'previewGurus'
        ));
    }

    // ==========================================
    // KHUSUS ADMIN (Identitas Sekolah)
    // ==========================================

    public function index()
    {
        $user = auth()->user();
        $layout = ($user->role === 'super_admin') ? 'layouts.superadmin' : 'layouts.admin';
        
        $settings = Setting::all();
        return view('admin.settings.index', compact('layout', 'settings'));
    }

    public function edit()
    {
        $user = auth()->user();
        $layout = ($user->role === 'super_admin') ? 'layouts.superadmin' : 'layouts.admin';
        
        $settings = Setting::all();
        return view('admin.settings.edit', compact('layout', 'settings'));
    }

    public function update(Request $request)
    {
        // ✅ UBAH MAX 2048 JADI 10240 (10MB) AGAR BISA DIKOMPRES DULU
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string',
            'telepon_sekolah' => 'nullable|string|max:20',
            'email_sekolah' => 'nullable|email|max:255',
            'nomor_whatsapp' => 'nullable|string|max:20',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10240', 
        ]);

        // 1. Update field teks
        $fields = ['nama_sekolah', 'alamat_sekolah', 'telepon_sekolah', 'email_sekolah', 'nomor_whatsapp'];
        foreach ($fields as $field) {
            $setting = Setting::firstOrCreate(['key' => $field]);
            $setting->update(['value' => $request->$field]);
        }

        // 2. Handle Hapus Logo (Dari tombol "Hapus Logo" di frontend)
        if ($request->has('remove_logo') && $request->remove_logo == '1') {
            $oldLogo = Setting::where('key', 'logo_sekolah')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete('logos/' . $oldLogo->value);
                $oldLogo->update(['value' => null]);
            }
        }

        // 3. Handle Upload Logo Baru dengan Kompresi
        if ($request->hasFile('logo_sekolah')) {
            $file = $request->file('logo_sekolah');
            
            // Hapus logo lama jika ada (untuk mencegah file sampah menumpuk)
            $oldLogo = Setting::where('key', 'logo_sekolah')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete('logos/' . $oldLogo->value);
            }

            // Kompres dan simpan file baru
            $filename = $this->compressLogo($file);

            // Update database
            $setting = Setting::firstOrCreate(['key' => 'logo_sekolah']);
            $setting->update(['value' => $filename]);
        }

        return redirect('/admin/settings')->with('success', 'Identitas sekolah berhasil diperbarui!');
    }

    /**
     * Fungsi Kompresi Logo - Target < 2MB
     * Resize max 800px, kompresi bertahap sampai ukuran file < 2MB
     */
    private function compressLogo($file)
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
            $filename = 'logo_' . time() . '_' . uniqid() . '.svg';
            $path = 'logos/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($tempPath));
            return $filename;
        }
        
        // Buat resource gambar
        if ($mime == 'image/jpeg' || $mime == 'image/jpg') {
            $source = imagecreatefromjpeg($tempPath);
        } elseif ($mime == 'image/png') {
            $source = imagecreatefrompng($tempPath);
        } else {
            throw new \Exception('Format gambar tidak didukung.');
        }

        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        // Resize jika terlalu besar (max 800px untuk logo agar tetap tajam tapi ringan)
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
        $tempFile = tempnam(sys_get_temp_dir(), 'compressed_logo');
        
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
        $filename = 'logo_' . time() . '_' . uniqid() . '.' . $extension;
        $path = 'logos/' . $filename;
        
        // Simpan ke storage Laravel
        Storage::disk('public')->put($path, file_get_contents($tempFile));
        
        // Cleanup memory & file temporary
        imagedestroy($source);
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
        
        return $filename;
    }

    /**
     * Tampilkan halaman pengaturan paket (Super Admin)
     */
    public function packageSettings()
    {
        $currentPackage = Setting::where('key', 'package_level')->value('value') ?? 'full';
        
        $packageOptions = [
            'easy' => [
                'name' => 'Easy',
                'price' => 'Rp 500.000/bulan',
                'color' => '#10B981',
                'features' => ['Profil Sekolah', 'Berita & Artikel', 'Galeri Foto', 'Kontak'],
                'description' => 'Paket dasar untuk sekolah yang baru memulai digitalisasi.'
            ],
            'medium' => [
                'name' => 'Medium',
                'price' => 'Rp 1.500.000/bulan',
                'color' => '#F59E0B',
                'features' => ['Semua fitur Easy', 'Portal Guru', 'Kompetensi Keahlian', 'PPDB Online', 'Lamaran Guru'],
                'description' => 'Paket menengah untuk sekolah yang ingin fitur akademik lengkap.'
            ],
            'full' => [
                'name' => 'Full Service',
                'price' => 'Rp 3.000.000/bulan',
                'color' => '#7C3AED',
                'features' => ['Semua fitur Medium', 'Alumni dengan Statistik', 'Dashboard Analytics', 'Priority Support'],
                'description' => 'Paket lengkap untuk sekolah yang ingin semua fitur premium.'
            ],
        ];

        return view('admin.package-settings', compact('currentPackage', 'packageOptions'));
    }

    public function updatePackage(Request $request)
    {
        $request->validate([
            'package_level' => 'required|in:easy,medium,full',
        ]);

        $setting = Setting::firstOrCreate(['key' => 'package_level']);
        $setting->update(['value' => $request->package_level]);

        return redirect('/admin/package-settings')->with('success', 'Paket berhasil diperbarui!');
    }
}