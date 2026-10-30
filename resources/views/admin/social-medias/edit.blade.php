@extends('layouts.admin')

@section('title', 'Edit Sosial Media')

@section('content')
<div class="dashboard-header">
    <h1 class="dashboard-header-title">Edit Sosial Media</h1>
    <p class="dashboard-header-subtitle">Update informasi sosial media</p>
</div>

<div class="content-section" style="max-width: 600px;">
    <form action="{{ route('admin.social-medias.update', $socialMedia) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Platform</label>
            <select name="platform" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
                <option value="facebook" {{ $socialMedia->platform == 'facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="instagram" {{ $socialMedia->platform == 'instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="twitter" {{ $socialMedia->platform == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                <option value="youtube" {{ $socialMedia->platform == 'youtube' ? 'selected' : '' }}>YouTube</option>
                <option value="tiktok" {{ $socialMedia->platform == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                <option value="whatsapp" {{ $socialMedia->platform == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                <option value="telegram" {{ $socialMedia->platform == 'telegram' ? 'selected' : '' }}>Telegram</option>
                <option value="linkedin" {{ $socialMedia->platform == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nama Platform</label>
            <input type="text" name="name" required value="{{ $socialMedia->name }}"
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">URL Lengkap</label>
            <input type="url" name="url" required value="{{ $socialMedia->url }}"
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Icon (Emoji)</label>
            <input type="text" name="icon" value="{{ $socialMedia->icon }}" maxlength="10"
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Urutan Tampilan</label>
            <input type="number" name="order" value="{{ $socialMedia->order }}"
                style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; background: var(--bg-secondary); color: var(--text-primary);">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" {{ $socialMedia->is_active ? 'checked' : '' }}
                    style="width: 18px; height: 18px; cursor: pointer;">
                <span>Aktifkan sosial media ini</span>
            </label>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-see-website" style="border: none; cursor: pointer;">
                Update
            </button>
            <a href="{{ route('admin.social-medias.index') }}" style="padding: 12px 24px; background: var(--bg-tertiary); color: var(--text-primary); border-radius: 10px; text-decoration: none;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection