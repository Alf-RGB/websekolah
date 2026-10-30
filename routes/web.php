<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruAuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\LamaranGuruController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\PortalPublicController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PortalController;

// =================================================================
// 1. ROUTE PUBLIK (TIDAK PERLU LOGIN)
// =================================================================

Route::get('/', [SettingController::class, 'publicHome'])->name('home');

// Berita & Halaman
Route::get('/berita', [PostController::class, 'publicNews'])->name('berita.index');
Route::get('/berita/{slug}', [PostController::class, 'publicShow'])->name('berita.show');
Route::get('/halaman/{slug}', [PageController::class, 'publicShow'])->name('page.show');
Route::get('/profil', [PageController::class, 'publicProfil'])->name('profil');
Route::get('/profil/guru', [GuruController::class, 'publicIndex'])->name('profil.guru');

// Galeri
Route::get('/galeri', [GalleryController::class, 'publicGallery'])->name('galeri.index');
Route::get('/galeri/{slug}', [GalleryController::class, 'publicShow'])->name('galeri.show');

// PPDB & Cek Status
Route::get('/portal-akademik/ppdb', [PendaftarController::class, 'publicForm'])->name('ppdb.form');
Route::post('/portal-akademik/ppdb', [PendaftarController::class, 'publicStore'])->name('ppdb.store');
Route::get('/ppdb/cek-status', [JoinUsController::class, 'showCekStatusForm'])->name('ppdb.cek-status');
Route::post('/ppdb/cek-status', [JoinUsController::class, 'cekStatus'])->name('ppdb.cek-status.process');

// Portal Akademik Publik
Route::get('/portal-akademik', [PortalPublicController::class, 'daftarGuru'])->name('portal.guru');
Route::get('/portal-akademik/download/{id}', [PortalPublicController::class, 'downloadMateri'])->name('portal.materi.download');
Route::get('/portal-akademik/jurusan', [KompetensiController::class, 'publicIndex'])->name('portal.jurusan');
Route::get('/portal-akademik/jurusan/{slug}', [KompetensiController::class, 'publicShow'])->name('portal.jurusan.show');
Route::get('/portal-akademik/guru/{id}', [PortalPublicController::class, 'detailGuru'])->name('portal.guru.detail');

// Alumni & Join Us Publik
Route::get('/alumni', [AlumniController::class, 'publicIndex'])->name('alumni.index');
Route::get('/alumni/daftar', [AlumniController::class, 'publicForm'])->name('alumni.form');
Route::post('/alumni/daftar', [AlumniController::class, 'publicStore'])->name('alumni.store');
Route::get('/portal-akademik/alumni', [AlumniController::class, 'publicIndex'])->name('portal.alumni');

Route::get('/kontak', function () {
    $settings = \App\Models\Setting::pluck('value', 'key');
    return view('public.kontak', compact('settings'));
})->name('kontak');

Route::get('/join-us', [JoinUsController::class, 'index'])->name('join-us');
Route::get('/join-us/siswa', [JoinUsController::class, 'redirectSiswa'])->name('join-us.siswa');
Route::get('/join-us/guru', [JoinUsController::class, 'formGuru'])->name('join-us.guru.form');
Route::post('/join-us/guru', [JoinUsController::class, 'storeGuru'])->name('join-us.guru.store');

// Auth Admin Publik
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =================================================================
// 2. ROUTE PORTAL GURU (LOGIN & DASHBOARD)
// =================================================================

// Login Guru (PUBLIK)
Route::get('/portal', fn() => redirect()->route('portal.login'));
Route::get('/portal/login', [GuruAuthController::class, 'showLogin'])->name('portal.guru.login');
Route::post('/portal/login', [GuruAuthController::class, 'login'])->name('portal.guru.login.process');
Route::post('/portal/logout', [GuruAuthController::class, 'logout'])->name('portal.guru.logout');

// ✅ Dashboard & Fitur Guru (DILINDUNGI MIDDLEWARE 'auth:guru' DAN 'guru.active')
Route::middleware(['auth:guru', 'guru.active'])->prefix('portal-akademik')->group(function () {
       Route::get('/', [GuruAuthController::class, 'dashboard'])->name('portal.guru.dashboard');
       Route::get('/materi', [GuruAuthController::class, 'materi'])->name('portal.guru.materi');
       Route::get('/profil', [GuruAuthController::class, 'profil'])->name('portal.guru.profil');
       Route::put('/profil', [GuruAuthController::class, 'updateProfile'])->name('portal.guru.profil.update');

    // CRUD Materi Ajar (Khusus Guru)
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
});

// ✅ Tambahan Route Portal Akademik Guru (Jika berbeda prefix)
Route::middleware(['auth:guru', 'guru.active'])->prefix('portal-akademik')->group(function () {
    Route::get('/', [GuruAuthController::class, 'dashboard'])->name('portal.guru.dashboard');
    Route::get('/materi', [GuruAuthController::class, 'materi'])->name('portal.guru.materi');
    Route::get('/profil', [GuruAuthController::class, 'profil'])->name('portal.guru.profil');
});


// =================================================================
// 3. ROUTE ADMIN STANDAR (DIKUNCI MIDDLEWARE 'admin')
// =================================================================
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengaturan / Identitas Sekolah
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Kompetensi Keahlian
    Route::get('/kompetensi', [KompetensiController::class, 'index'])->name('kompetensi.index');
    Route::get('/kompetensi/create', [KompetensiController::class, 'create'])->name('kompetensi.create');
    Route::post('/kompetensi', [KompetensiController::class, 'store'])->name('kompetensi.store');
    Route::get('/kompetensi/{id}/edit', [KompetensiController::class, 'edit'])->name('kompetensi.edit');
    Route::put('/kompetensi/{id}', [KompetensiController::class, 'update'])->name('kompetensi.update');
    Route::delete('/kompetensi/{id}', [KompetensiController::class, 'destroy'])->name('kompetensi.destroy');

    // Resource Routes (Posts & Galleries)
    Route::resource('posts', PostController::class);
    Route::resource('galleries', GalleryController::class);

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');

    // PENDAFTAR
    Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/{id}', [PendaftarController::class, 'show'])->name('pendaftar.show');
    Route::get('/pendaftar/{id}/edit', [PendaftarController::class, 'edit'])->name('pendaftar.edit');
    Route::put('/pendaftar/{id}', [PendaftarController::class, 'update'])->name('pendaftar.update');
    Route::delete('/pendaftar/{id}', [PendaftarController::class, 'destroy'])->name('pendaftar.destroy');
    Route::patch('/pendaftar/{id}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.update-status');

    // Kelola Guru (Admin)
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::put('/guru/{id}/reset-password', [GuruController::class, 'resetPassword'])->name('guru.reset-password');
    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // Lamaran Guru
    Route::get('/lamaran', [LamaranGuruController::class, 'index'])->name('lamaran.index');
    Route::get('/lamaran/{id}/detail', [LamaranGuruController::class, 'showDetail'])->name('lamaran.detail');
    Route::put('/lamaran/{id}', [LamaranGuruController::class, 'update'])->name('lamaran.update');
    Route::put('/lamaran/{id}/update-status', [LamaranGuruController::class, 'updateStatus'])->name('lamaran.updateStatus');
    Route::delete('/lamaran/{id}', [LamaranGuruController::class, 'destroy'])->name('lamaran.destroy');

        // Kelola Alumni (Admin)
    Route::get('/alumni', [AlumniController::class, 'adminIndex'])->name('alumni.index');
    Route::get('/alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
    Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');
    Route::get('/alumni/{id}/edit', [AlumniController::class, 'edit'])->name('alumni.edit');
    Route::put('/alumni/{id}', [AlumniController::class, 'update'])->name('alumni.update');
    Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
    Route::patch('/alumni/{id}/toggle-featured', [AlumniController::class, 'toggleFeatured'])->name('alumni.toggle');

        // Social Media Routes
    Route::resource('social-medias', \App\Http\Controllers\Admin\SocialMediaController::class);


});


// =================================================================
// 4. ROUTE KHUSUS SUPER ADMIN (DIKUNCI MIDDLEWARE 'super_admin')
// =================================================================
Route::middleware('super_admin')->prefix('admin')->name('admin.super.')->group(function () {
    // Kelola User Admin
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Pengaturan Paket (Khusus Super Admin)
    Route::get('/package-settings', [SettingController::class, 'packageSettings'])->name('package.settings');
    Route::put('/package-settings', [SettingController::class, 'updatePackage'])->name('package.update');
});