@extends('layouts.admin')

@section('title', 'Kelola Sosial Media')

@section('content')
<div class="dashboard-header">
    <h1 class="dashboard-header-title">Kelola Sosial Media</h1>
    <p class="dashboard-header-subtitle">Kelola link sosial media sekolah Anda</p>
</div>

<div class="content-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 class="section-title" style="margin: 0;">Daftar Sosial Media</h2>
        <a href="{{ route('admin.social-medias.create') }}" class="btn-see-website" style="text-decoration: none;">
            + Tambah Sosial Media
        </a>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; padding: 16px; border-radius: 10px; margin-bottom: 20px; color: #10B981;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--bg-tertiary); border-bottom: 2px solid var(--border-color);">
                <th style="padding: 12px; text-align: left;">Platform</th>
                <th style="padding: 12px; text-align: left;">Nama</th>
                <th style="padding: 12px; text-align: left;">URL</th>
                <th style="padding: 12px; text-align: center;">Urutan</th>
                <th style="padding: 12px; text-align: center;">Status</th>
                <th style="padding: 12px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($socialMedias as $social)
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 12px;">
                    <span style="font-size: 20px;">{{ $social->icon }}</span>
                    <span style="margin-left: 8px;">{{ ucfirst($social->platform) }}</span>
                </td>
                <td style="padding: 12px;">{{ $social->name }}</td>
                <td style="padding: 12px; max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                    {{ $social->url }}
                </td>
                <td style="padding: 12px; text-align: center;">{{ $social->order }}</td>
                <td style="padding: 12px; text-align: center;">
                    <span style="padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; background: {{ $social->is_active ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)' }}; color: {{ $social->is_active ? '#10B981' : '#EF4444' }};">
                        {{ $social->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td style="padding: 12px; text-align: center;">
                    <a href="{{ route('admin.social-medias.edit', $social) }}" style="padding: 6px 12px; background: rgba(59, 130, 246, 0.1); color: #3B82F6; border-radius: 6px; text-decoration: none; margin-right: 8px;">Edit</a>
                    <form action="{{ route('admin.social-medias.destroy', $social) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 6px 12px; background: rgba(239, 68, 68, 0.1); color: #EF4444; border: none; border-radius: 6px; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-muted);">
                    Belum ada sosial media. <a href="{{ route('admin.social-medias.create') }}" style="color: #6366f1;">Tambahkan sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection