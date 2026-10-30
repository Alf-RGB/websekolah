@extends('layouts.app')

@section('title', 'Alumni - ' . ($data['nama_sekolah'] ?? 'Sekolah'))

@section('content')

<style>
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
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5);
    }

    /* =========================================
       2. GLOBAL RESET & ANIMATIONS
       ========================================= */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    .alumni-wrapper { 
        max-width: 1200px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

    /* =========================================
       3. PAGE HEADER
       ========================================= */
    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 40px; 
        flex-wrap: wrap; 
        gap: 20px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 { 
        color: var(--text-primary); 
        font-size: 32px; 
        margin-bottom: 8px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 15px; 
    }

    .btn-register {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3);
    }
    .btn-register:active { transform: translateY(0) scale(0.98); }

    /* =========================================
       4. SECTION TITLES
       ========================================= */
    .section-title {
        color: var(--text-primary);
        font-size: 22px;
        margin-bottom: 25px;
        border-left: 4px solid var(--primary-hover);
        padding-left: 15px;
        font-weight: 700;
        animation: fadeInUp 0.6s ease-out 0.1s backwards;
    }

    /* =========================================
       5. ALUMNI GRID & CARDS
       ========================================= */
    .alumni-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 60px;
    }

    .alumni-card {
        background: var(--bg-secondary);
        padding: 30px 25px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        text-align: center;
        transition: var(--transition-smooth);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    /* Staggered Animation Delays */
    .alumni-card:nth-child(1) { animation-delay: 0.1s; }
    .alumni-card:nth-child(2) { animation-delay: 0.15s; }
    .alumni-card:nth-child(3) { animation-delay: 0.2s; }
    .alumni-card:nth-child(4) { animation-delay: 0.25s; }
    .alumni-card:nth-child(5) { animation-delay: 0.3s; }
    .alumni-card:nth-child(6) { animation-delay: 0.35s; }

    .alumni-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-hover);
    }

    .alumni-photo-container {
        width: 90px;
        height: 90px;
        margin: 0 auto 15px;
        position: relative;
    }
    .alumni-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--bg-tertiary);
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
    }
    .alumni-card:hover .alumni-photo {
        transform: scale(1.1) rotate(-3deg);
        border-color: var(--primary-hover);
    }
    .alumni-photo-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: white;
        font-weight: 800;
        border: 4px solid var(--bg-tertiary);
        transition: var(--transition-smooth);
    }
    .alumni-card:hover .alumni-photo-placeholder {
        transform: scale(1.1) rotate(-3deg);
        border-color: var(--primary-hover);
    }

    .alumni-name {
        color: var(--text-primary);
        font-size: 18px;
        margin-bottom: 5px;
        font-weight: 700;
        word-wrap: break-word;
    }
    .alumni-meta {
        color: var(--text-secondary);
        font-size: 13px;
        margin-bottom: 15px;
        font-weight: 500;
    }
    
    .alumni-status-box {
        background: var(--bg-tertiary);
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 15px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        flex-grow: 1; /* Pushes testimonial down */
    }
    .alumni-card:hover .alumni-status-box {
        background: var(--bg-primary);
        border-color: var(--primary-hover);
    }
    .alumni-status-title {
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }
    .alumni-status-subtitle {
        color: var(--text-secondary);
        font-size: 12px;
        margin: 4px 0 0 0;
    }

    .alumni-testimoni {
        color: var(--text-secondary);
        font-size: 13px;
        line-height: 1.6;
        font-style: italic;
        margin: 0;
        position: relative;
        padding: 0 10px;
        text-align: left;
    }
    .testimoni-quote {
        font-size: 24px;
        color: var(--primary-hover);
        position: absolute;
        opacity: 0.3;
        font-family: serif;
    }
    .quote-start { top: -10px; left: -5px; }
    .quote-end { bottom: -15px; right: -5px; }

    /* =========================================
       6. EMPTY STATE
       ========================================= */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon {
        font-size: 60px;
        margin-bottom: 15px;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }
    .empty-state h3 {
        color: var(--text-primary);
        margin-bottom: 8px;
        font-size: 20px;
        font-weight: 700;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 14px;
        margin: 0 0 20px 0;
    }

    /* =========================================
       7. STATISTICS SECTION
       ========================================= */
    .stats-section {
        background: var(--bg-secondary);
        padding: 30px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out 0.2s backwards;
    }
    .stats-title {
        color: var(--text-primary);
        font-size: 22px;
        margin-bottom: 25px;
        text-align: center;
        font-weight: 700;
    }
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    .chart-container h3 {
        color: var(--text-primary);
        font-size: 15px;
        margin-bottom: 15px;
        text-align: center;
        font-weight: 600;
    }
    .chart-wrapper {
        position: relative;
        height: 250px;
        width: 100%;
    }
    .chart-wrapper.doughnut {
        max-width: 300px;
        margin: 0 auto;
    }

    /* =========================================
       8. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .btn-register {
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.4);
    }
    [data-theme="dark"] .alumni-photo,
    [data-theme="dark"] .alumni-photo-placeholder {
        border-color: #334155;
    }
    [data-theme="dark"] .alumni-card:hover .alumni-photo,
    [data-theme="dark"] .alumni-card:hover .alumni-photo-placeholder {
        border-color: var(--primary-hover);
    }

    /* =========================================
       9. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .alumni-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .page-header h1 { font-size: 26px; }
        .btn-register { width: 100%; justify-content: center; }
        .alumni-grid { grid-template-columns: 1fr; }
        .stats-section { padding: 20px; }
    }
</style>

<div class="alumni-wrapper">
    
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>🎓 Alumni Kami</h1>
            <p>Kisah sukses para alumni yang menjadi inspirasi dan kebanggaan sekolah.</p>
        </div>
        <a href="/alumni/daftar" class="btn-register">
            ✍️ Daftarkan Diri
        </a>
    </div>

    {{-- BAGIAN 1: DAFTAR ALUMNI TERBAIK --}}
    <h2 class="section-title">Alumni Terbaik & Terbaru</h2>
    
    <div class="alumni-grid">
        @forelse($alumnis as $alumni)
            <div class="alumni-card">
                {{-- Foto --}}
                @php
                    $fotoExists = $alumni->foto && file_exists(storage_path('app/public/alumni/' . $alumni->foto));
                @endphp

                <div class="alumni-photo-container">
                    @if($fotoExists)
                        <img src="{{ asset('storage/alumni/' . $alumni->foto) }}" alt="Foto {{ $alumni->nama_lengkap }}" class="alumni-photo" loading="lazy">
                    @else
                        <div class="alumni-photo-placeholder">
                            {{ strtoupper(substr($alumni->nama_lengkap, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <h3 class="alumni-name">{{ $alumni->nama_lengkap }}</h3>
                <p class="alumni-meta">
                    Angkatan {{ $alumni->tahun_lulus }} {{ $alumni->jurusan ? '• ' . $alumni->jurusan : '' }}
                </p>
                
                <div class="alumni-status-box">
                    <p class="alumni-status-title">
                        {{ $alumni->jabatan ?? $alumni->status_sekarang }}
                    </p>
                    @if($alumni->nama_instansi)
                        <p class="alumni-status-subtitle">{{ $alumni->nama_instansi }}</p>
                    @endif
                </div>

                @if($alumni->testimoni)
                    <p class="alumni-testimoni">
                        <span class="testimoni-quote quote-start">"</span>
                        {{ Str::limit($alumni->testimoni, 90) }}
                        <span class="testimoni-quote quote-end">"</span>
                    </p>
                @endif
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">🎓</div>
                <h3>Belum Ada Data Alumni</h3>
                <p>Jadilah yang pertama membagikan kisah suksesmu!</p>
                <a href="/alumni/daftar" class="btn-register">
                    ✍️ Daftarkan Diri Sekarang
                </a>
            </div>
        @endforelse
    </div>

    {{-- BAGIAN 2: STATISTIK DENGAN DIAGRAM --}}
    @if(($statistikTahun ?? collect())->isNotEmpty() || ($statistikStatus ?? collect())->isNotEmpty())
        <div class="stats-section">
            <h2 class="stats-title">📊 Statistik Alumni</h2>
            
            <div class="charts-grid">
                @if(isset($statistikTahun) && $statistikTahun->isNotEmpty())
                    <div class="chart-container">
                        <h3>Lulusan Per Tahun</h3>
                        <div class="chart-wrapper">
                            <canvas id="chartTahun"></canvas>
                        </div>
                    </div>
                @endif
                
                @if(isset($statistikStatus) && $statistikStatus->isNotEmpty())
                    <div class="chart-container">
                        <h3>Status Saat Ini</h3>
                        <div class="chart-wrapper doughnut">
                            <canvas id="chartStatus"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Cek mode gelap untuk menyesuaikan warna chart
                const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
                const gridColor = isDarkMode ? 'rgba(148, 163, 184, 0.2)' : 'rgba(148, 163, 184, 0.1)';
                const textColor = isDarkMode ? '#CBD5E1' : '#475569';

                const warnaPrimary = '#1D3557';
                const warnaSecondary = '#457B9D';
                const warnaHijau = '#10B981';
                const warnaKuning = '#F59E0B';
                const warnaUngu = '#8B5CF6';

                @if(isset($statistikTahun) && $statistikTahun->isNotEmpty())
                    const ctxTahun = document.getElementById('chartTahun').getContext('2d');
                    new Chart(ctxTahun, {
                        type: 'bar',
                        data: {
                            labels: @json($statistikTahun->pluck('tahun_lulus')),
                            datasets: [{
                                label: 'Jumlah',
                                data: @json($statistikTahun->pluck('total')),
                                backgroundColor: warnaSecondary,
                                borderColor: warnaPrimary,
                                borderWidth: 1,
                                borderRadius: 8,
                                borderSkipped: false,
                                hoverBackgroundColor: warnaPrimary,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { 
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: isDarkMode ? '#1E293B' : '#0F172A',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    padding: 10,
                                    cornerRadius: 8,
                                    displayColors: false,
                                }
                            },
                            scales: {
                                y: { 
                                    beginAtZero: true, 
                                    ticks: { stepSize: 1, color: textColor },
                                    grid: { color: gridColor, borderDash: [5, 5] }
                                },
                                x: { 
                                    grid: { display: false },
                                    ticks: { color: textColor }
                                }
                            },
                            animation: {
                                duration: 1500,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                @endif

                @if(isset($statistikStatus) && $statistikStatus->isNotEmpty())
                    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
                    new Chart(ctxStatus, {
                        type: 'doughnut',
                        data: {
                            labels: @json($statistikStatus->pluck('status_sekarang')),
                            datasets: [{
                                data: @json($statistikStatus->pluck('total')),
                                backgroundColor: [warnaPrimary, warnaHijau, warnaKuning, warnaUngu],
                                borderColor: isDarkMode ? '#1E293B' : '#ffffff',
                                borderWidth: 3,
                                hoverOffset: 10,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '65%',
                            plugins: {
                                legend: { 
                                    position: 'bottom', 
                                    labels: { 
                                        usePointStyle: true, 
                                        padding: 20,
                                        color: textColor,
                                        font: { family: 'Inter', size: 12 }
                                    } 
                                },
                                tooltip: {
                                    backgroundColor: isDarkMode ? '#1E293B' : '#0F172A',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    padding: 10,
                                    cornerRadius: 8,
                                }
                            },
                            animation: {
                                animateRotate: true,
                                duration: 1500,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                @endif
            });
        </script>
    @endif
</div>

@endsection