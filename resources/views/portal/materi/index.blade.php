<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Ajar Saya - Portal Guru</title>
    
    {{-- 🚨 ANTI-FLASH: Apply theme BEFORE rendering --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        /* =========================================
           1. CSS VARIABLES & THEME
           ========================================= */
        :root {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --bg-tertiary: #F1F5F9;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --text-muted: #94A3B8;
            --border-color: #E2E8F0;
            --accent-color: #10B981;
            --accent-hover: #059669;
            --danger-color: #EF4444;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-tertiary: #334155;
            --text-primary: #F1F5F9;
            --text-secondary: #CBD5E1;
            --text-muted: #94A3B8;
            --border-color: #334155;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        }

        /* =========================================
           2. GLOBAL RESET & ANIMATIONS
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            line-height: 1.6; 
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: scale(0.98) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        /* =========================================
           3. NAVBAR
           ========================================= */
        .navbar { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 16px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid var(--border-color);
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            box-shadow: var(--shadow-sm);
            animation: fadeInDown 0.6s ease-out;
        }
        [data-theme="dark"] .navbar { background: rgba(30, 41, 59, 0.8); }

        .navbar-brand { 
            font-size: 18px; 
            font-weight: 800; 
            color: var(--text-primary); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            transition: var(--transition-smooth);
        }
        .navbar-brand:hover { opacity: 0.8; transform: translateX(-2px); }

        .btn-back { 
            background: var(--bg-tertiary); 
            color: var(--text-primary); 
            padding: 8px 16px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 600; 
            transition: var(--transition-smooth); 
            border: 1px solid var(--border-color);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back:hover { 
            background: var(--border-color); 
            transform: translateX(-3px);
        }
        .btn-back:active { transform: translateX(-3px) scale(0.98); }

        /* =========================================
           4. CONTAINER & HEADER
           ========================================= */
        .container { 
            max-width: 1100px; 
            margin: 40px auto; 
            padding: 0 20px; 
            animation: fadeInUp 0.6s ease-out 0.1s backwards;
        }

        .page-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            flex-wrap: wrap; 
            gap: 15px; 
        }
        .page-header h1 { 
            color: var(--text-primary); 
            font-size: 26px; 
            font-weight: 800; 
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-add { 
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%); 
            color: white; 
            padding: 10px 20px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 14px; 
            transition: var(--transition-smooth); 
            display: inline-flex; 
            align-items: center; 
            gap: 6px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-add:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); 
        }
        .btn-add:active { transform: translateY(0) scale(0.98); }

        /* =========================================
           5. ALERTS & STATS
           ========================================= */
        .alert { 
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%); 
            color: #065F46; 
            padding: 14px 20px; 
            border-radius: 12px; 
            margin-bottom: 24px; 
            border: 1px solid #10B981; 
            font-size: 14px; 
            font-weight: 600; 
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.5s ease-out;
        }
        [data-theme="dark"] .alert {
            background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
            color: #6EE7B7 !important;
            border-color: #10B981 !important;
        }

        .stats-box { 
            background: var(--bg-secondary); 
            padding: 24px 28px; 
            border-radius: 16px; 
            box-shadow: var(--shadow-md); 
            margin-bottom: 28px; 
            display: flex; 
            gap: 40px; 
            flex-wrap: wrap; 
            border-left: 4px solid var(--accent-color);
            transition: var(--transition-smooth);
        }
        .stats-box:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        .stat-item { display: flex; flex-direction: column; }
        .stat-label { 
            font-size: 12px; 
            color: var(--text-muted); 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            font-weight: 600; 
        }
        .stat-value { 
            font-size: 28px; 
            font-weight: 800; 
            color: var(--text-primary); 
            margin-top: 4px; 
        }
        .stat-value.small { font-size: 16px; color: var(--accent-color); }

        /* =========================================
           6. CARD & TABLE
           ========================================= */
        .card { 
            background: var(--bg-secondary); 
            border-radius: 16px; 
            box-shadow: var(--shadow-md); 
            overflow: hidden; 
            border: 1px solid var(--border-color);
            animation: slideIn 0.6s ease-out 0.2s backwards;
        }
        .table-wrapper { overflow-x: auto; }
        
        table { width: 100%; border-collapse: collapse; }
        th { 
            padding: 16px 24px; 
            text-align: left; 
            background: var(--bg-tertiary); 
            color: var(--text-muted); 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            font-weight: 700; 
            border-bottom: 1px solid var(--border-color);
        }
        td { 
            padding: 20px 24px; 
            border-bottom: 1px solid var(--border-color); 
            vertical-align: middle;
        }
        tbody tr { 
            transition: var(--transition-smooth); 
            animation: fadeInUp 0.4s ease-out backwards;
        }
        tbody tr:hover { 
            background: var(--bg-tertiary); 
            transform: translateX(4px);
        }
        tbody tr:last-child td { border-bottom: none; }

        /* File Info */
        .file-info { display: flex; align-items: center; gap: 14px; }
        .file-icon { 
            width: 40px; 
            height: 40px; 
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%); 
            color: #991B1B; 
            border-radius: 10px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 12px; 
            font-weight: 800; 
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.15);
            transition: var(--transition-smooth);
        }
        tbody tr:hover .file-icon { transform: scale(1.1) rotate(-3deg); }
        
        .file-title { font-weight: 700; color: var(--text-primary); font-size: 15px; margin-bottom: 2px; }
        .file-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.4; }

        /* Action Buttons */
        .action-group { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn-action { 
            padding: 8px 14px; 
            border-radius: 8px; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: 600; 
            transition: var(--transition-smooth); 
            display: inline-flex; 
            align-items: center; 
            gap: 6px; 
            border: 1px solid transparent;
            cursor: pointer;
            font-family: inherit;
        }
        .btn-download { 
            background: #EFF6FF; 
            color: #1E40AF; 
            border-color: #BFDBFE; 
        }
        .btn-download:hover { 
            background: #1E40AF; 
            color: white; 
            border-color: #1E40AF;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
        }
        .btn-delete { 
            background: #FEE2E2; 
            color: #991B1B; 
            border-color: #FECACA;
        }
        .btn-delete:hover { 
            background: #991B1B; 
            color: white; 
            border-color: #991B1B;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.2);
        }
        .btn-action:active { transform: translateY(0) scale(0.95) !important; }

        .file-missing {
            font-size: 11px; 
            color: #991B1B; 
            background: #FEE2E2; 
            padding: 8px 12px; 
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* =========================================
           7. EMPTY STATE
           ========================================= */
        .empty-state { 
            text-align: center; 
            padding: 80px 40px; 
            animation: fadeInUp 0.6s ease-out;
        }
        .empty-icon { 
            font-size: 64px; 
            margin-bottom: 20px; 
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }
        .empty-title { 
            color: var(--text-primary); 
            font-size: 20px; 
            font-weight: 700; 
            margin-bottom: 8px; 
        }
        .empty-desc { 
            color: var(--text-secondary); 
            font-size: 14px; 
            margin-bottom: 24px; 
        }

        /* =========================================
           8. DARK MODE OVERRIDES
           ========================================= */
        [data-theme="dark"] .btn-back { background: var(--bg-tertiary); color: var(--text-primary); border-color: var(--border-color); }
        [data-theme="dark"] .btn-back:hover { background: var(--border-color); }
        [data-theme="dark"] .file-icon { background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.1) 100%); color: #FCA5A5; }
        [data-theme="dark"] .btn-download { background: rgba(30, 64, 175, 0.2); color: #93C5FD; border-color: rgba(30, 64, 175, 0.3); }
        [data-theme="dark"] .btn-download:hover { background: #1E40AF; color: white; }
        [data-theme="dark"] .btn-delete { background: rgba(153, 27, 27, 0.2); color: #FCA5A5; border-color: rgba(153, 27, 27, 0.3); }
        [data-theme="dark"] .btn-delete:hover { background: #991B1B; color: white; }
        [data-theme="dark"] .file-missing { background: rgba(153, 27, 27, 0.2); color: #FCA5A5; }

        /* =========================================
           9. RESPONSIVE
           ========================================= */
        @media (max-width: 768px) {
            .navbar { padding: 12px 20px; }
            .container { margin: 20px auto; padding: 0 15px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .stats-box { gap: 24px; padding: 20px; }
            .stat-value { font-size: 24px; }
            th, td { padding: 16px; }
            .action-group { flex-direction: column; }
            .btn-action { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/portal/guru/dashboard" class="navbar-brand">📚 Portal Guru</a>
        <a href="/portal/guru/dashboard" class="btn-back">← Kembali ke Dashboard</a>
    </nav>

    <div class="container">
        @if(session('success')) 
            <div class="alert">✅ {{ session('success') }}</div> 
        @endif

        <div class="page-header">
            <div>
                <h1>📖 Materi Ajar Saya</h1>
                <p>Kelola dan bagikan materi pembelajaran kepada siswa</p>
            </div>
            <a href="/portal/guru/materi/create" class="btn-add">+ Upload Materi Baru</a>
        </div>

        {{-- STATISTIK SINGKAT --}}
        <div class="stats-box">
            <div class="stat-item">
                <span class="stat-label">Total Materi</span>
                <span class="stat-value">{{ $materis->count() }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Upload Terbaru</span>
                <span class="stat-value small">
                    {{ $materis->isNotEmpty() ? $materis->sortByDesc('created_at')->first()->created_at->format('d M Y') : '-' }}
                </span>
            </div>
        </div>

        <div class="card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 45%;">Judul & Deskripsi</th>
                            <th style="width: 20%;">Tanggal Upload</th>
                            <th style="width: 35%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materis as $materi)
                            @php $delay = $loop->index * 0.05; @endphp
                            <tr style="animation-delay: {{ $delay }}s;">
                                <td>
                                    <div class="file-info">
                                        <div class="file-icon">PDF</div>
                                        <div style="flex: 1; min-width: 0;">
                                            <div class="file-title">{{ $materi->judul }}</div>
                                            @if($materi->deskripsi)
                                                <div class="file-desc" title="{{ $materi->deskripsi }}">
                                                    {{ Str::limit($materi->deskripsi, 60) }}
                                                </div>
                                            @else
                                                <div class="file-desc" style="font-style: italic;">Tanpa deskripsi</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 14px; color: var(--text-primary); font-weight: 600;">
                                        {{ $materi->created_at->format('d M Y') }}
                                    </div>
                                    <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">
                                        {{ $materi->created_at->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td>
                                    <div class="action-group">
                                        @if($materi->file_path && file_exists(public_path('materis/' . $materi->file_path)))
                                            <a href="{{ asset('materis/' . $materi->file_path) }}" target="_blank" class="btn-action btn-download" title="Lihat/Download File PDF">
                                                📥 Lihat PDF
                                            </a>
                                        @else
                                            <span class="file-missing">⚠️ File hilang</span>
                                        @endif

                                        <form action="/portal/guru/materi/{{ $materi->id }}" method="POST" style="display: inline;" onsubmit="return confirm('⚠️ Yakin ingin menghapus materi &quot;{{ $materi->judul }}&quot;?\n\nFile PDF juga akan dihapus permanen dari server.')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Materi">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="empty-state">
                                        <div class="empty-icon">📂</div>
                                        <div class="empty-title">Belum Ada Materi</div>
                                        <div class="empty-desc">Mulai upload materi ajar pertama Anda untuk dibagikan ke siswa.</div>
                                        <a href="/portal/guru/materi/create" class="btn-add">+ Upload Materi Pertama</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>