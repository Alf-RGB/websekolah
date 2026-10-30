@extends('layouts.admin')

@section('title', 'Tambah Sosial Media')

@section('content')
<div class="dashboard-header">
    <h1 class="dashboard-header-title">Tambah Sosial Media</h1>
    <p class="dashboard-header-subtitle">Tambahkan link sosial media sekolah</p>
</div>

<div class="content-section" style="max-width: 600px;">
    <form action="{{ route('admin.social-medias.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Platform</label>
            <select name="platform" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="twitter">Twitter/X</option>
                <option value="youtube">YouTube</option>
                <option value="tiktok">TikTok</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="telegram">Telegram</option>
                <option value="linkedin">LinkedIn</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nama Platform</label>
            <input type="text" name="name" required placeholder="Contoh: Facebook Sekolah" 
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">URL Lengkap</label>
            <input type="url" name="url" required placeholder="https://facebook.com/namasekolah" 
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Icon (Emoji)</label>
            <input type="text" name="icon" placeholder="Contoh:  atau f" maxlength="10"
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
            <small style="color: var(--text-muted);">Gunakan emoji atau karakter untuk icon</small>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Urutan Tampilan</label>
            <input type="number" name="order" placeholder="0" 
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" checked 
                    style="width: 18px; height: 18px; cursor: pointer;">
                <span>Aktifkan sosial media ini</span>
            </label>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-see-website" style="border: none; cursor: pointer;">
                Simpan
            </button>
            <a href="{{ route('admin.social-medias.index') }}" style="padding: 12px 24px; background: var(--bg-tertiary); color: var(--text-primary); border-radius: 10px; text-decoration: none;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection