@extends($layout)

@section('title', 'Kelola User Admin')

@section('content')

<style>
    /* =========================================
       1. CSS VARIABLES & ANIMATIONS
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --accent-purple: #8B5CF6;
        --accent-green: #10B981;
        --gradient-admin: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
        --gradient-super: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%);
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

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .admin-users-wrapper { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 30px; 
        flex-wrap: wrap; 
        gap: 15px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 { 
        color: var(--text-primary); 
        font-size: 26px; 
        font-weight: 700; 
        margin: 0 0 5px 0; 
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 14px; 
        margin: 0; 
    }

    .header-actions { display: flex; gap: 10px; }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        cursor: pointer;
    }
    .btn-secondary {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }
    .btn-secondary:hover {
        background: var(--bg-tertiary);
        border-color: var(--primary-hover);
        color: var(--primary-hover);
        transform: translateX(-3px);
    }
    .btn-primary {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        box-shadow: 0 2px 8px rgba(29, 53, 87, 0.2);
    }
    .btn-primary:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.3);
    }
    .btn:active { transform: translateY(0) scale(0.98) !important; }

    /* =========================================
       3. ALERTS
       ========================================= */
    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 14px;
        font-weight: 500;
        animation: fadeInDown 0.5s ease-out;
    }
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border: 1px solid #A7F3D0;
        border-left: 4px solid #22C55E;
    }
    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 1px solid #FECACA;
        border-left: 4px solid #EF4444;
    }

    /* =========================================
       4. STATS CARDS
       ========================================= */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: var(--bg-secondary);
        padding: 18px 22px;
        border-radius: 12px;
        border-left: 4px solid var(--primary-color);
        box-shadow: var(--shadow-md);
        transition: var(--transition-smooth);
        animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.15s; border-left-color: var(--accent-purple); }
    .stat-card:nth-child(3) { animation-delay: 0.2s; border-left-color: var(--accent-green); }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    .stat-label {
        font-size: 12px;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .stat-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--primary-color);
        margin-top: 5px;
    }
    .stat-card:nth-child(2) .stat-value { color: var(--accent-purple); }
    .stat-card:nth-child(3) .stat-value { color: var(--accent-green); }

    /* =========================================
       5. USER CARDS GRID
       ========================================= */
    .users-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
        animation: fadeInUp 0.6s ease-out 0.25s backwards;
    }

    .user-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        display: flex;
        flex-direction: column;
    }
    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .user-card-header {
        padding: 25px;
        position: relative;
        color: white;
    }
    .user-card-header-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        font-weight: 700;
        border: 3px solid white;
        flex-shrink: 0;
        backdrop-filter: blur(4px);
    }
    .user-info h3 {
        color: white;
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 4px 0;
        word-wrap: break-word;
    }
    .user-info p {
        color: rgba(255,255,255,0.9);
        font-size: 13px;
        margin: 0;
        word-wrap: break-word;
    }

    .role-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255,255,255,0.95);
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .role-badge.super { color: #8B5CF6; }
    .role-badge.admin { color: #1D3557; }

    .user-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .user-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }
    .meta-label {
        font-size: 10px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .meta-value {
        margin-top: 3px;
        font-size: 13px;
        color: var(--text-primary);
        font-weight: 600;
    }

    .current-user-badge {
        padding: 10px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(59, 130, 246, 0.2);
        font-size: 12px;
        color: #1E40AF;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    [data-theme="dark"] .current-user-badge {
        background: rgba(59, 130, 246, 0.15);
        color: #93C5FD;
        border-color: rgba(59, 130, 246, 0.3);
    }

    .user-actions {
        display: flex;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
        margin-top: auto;
    }

    .btn-action {
        flex: 1;
        padding: 11px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        text-align: center;
        transition: var(--transition-smooth);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .btn-edit {
        background: var(--primary-color);
        color: white;
    }
    .btn-edit:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }
    .btn-delete {
        background: #FEE2E2;
        color: #991B1B;
    }
    .btn-delete:hover {
        background: #FECACA;
        transform: translateY(-2px);
    }
    .btn-delete:disabled {
        background: var(--bg-tertiary);
        color: var(--text-muted);
        cursor: not-allowed;
        transform: none;
        border: 1px solid var(--border-color);
    }

    /* =========================================
       6. EMPTY STATE
       ========================================= */
    .empty-state {
        background: var(--bg-secondary);
        padding: 60px 40px;
        border-radius: 16px;
        text-align: center;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon { font-size: 60px; margin-bottom: 15px; display: inline-block; }
    .empty-state h3 {
        color: var(--text-primary);
        font-size: 20px;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 14px;
        margin-bottom: 25px;
    }

    /* =========================================
       7. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .alert-success {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        color: #6EE7B7 !important;
        border-color: #065F46 !important;
    }
    [data-theme="dark"] .alert-error {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
        color: #FCA5A5 !important;
        border-color: #991B1B !important;
    }
    [data-theme="dark"] .stat-card,
    [data-theme="dark"] .user-card,
    [data-theme="dark"] .empty-state {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    /* =========================================
       8. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .admin-users-wrapper { padding: 15px; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .header-actions { width: 100%; }
        .header-actions .btn { flex: 1; justify-content: center; }
        .users-grid { grid-template-columns: 1fr; }
        .user-actions { flex-direction: column; }
    }
</style>

<div class="admin-users-wrapper">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>Kelola User Admin</h1>
            <p>Manajemen akun admin dan super admin</p>
        </div>
        <div class="header-actions">
            <a href="/admin/dashboard" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Dashboard
            </a>
            <a href="/admin/users/create" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Tambah User
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- STATISTIK --}}
    @php
        $totalUsers = $users->count();
        $superAdmins = $users->where('role', 'super_admin')->count();
        $admins = $totalUsers - $superAdmins;
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total User</div>
            <div class="stat-value">{{ $totalUsers }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Super Admin</div>
            <div class="stat-value">{{ $superAdmins }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Admin</div>
            <div class="stat-value">{{ $admins }}</div>
        </div>
    </div>

    {{-- GRID CARD USER --}}
    @if($users->isNotEmpty())
        <div class="users-grid">
            @foreach($users as $user)
                <div class="user-card">
                    {{-- Header Card --}}
                    <div class="user-card-header" style="background: {{ $user->role === 'super_admin' ? 'var(--gradient-super)' : 'var(--gradient-admin)' }};">
                        <div class="user-card-header-content">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        {{-- Badge Role --}}
                        <div class="role-badge {{ $user->role === 'super_admin' ? 'super' : 'admin' }}">
                            {{ $user->role === 'super_admin' ? '👑 Super Admin' : '🔑 Admin' }}
                        </div>
                    </div>

                    {{-- Body Card --}}
                    <div class="user-card-body">
                        <div class="user-meta-grid">
                            <div>
                                <div class="meta-label">Username</div>
                                <div class="meta-value">{{ $user->username }}</div>
                            </div>
                            <div>
                                <div class="meta-label">Bergabung</div>
                                <div class="meta-value">{{ $user->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        @if($user->id === auth()->id())
                            <div class="current-user-badge">
                                <span>👤</span> <strong>Anda:</strong> Ini adalah akun Anda saat ini
                            </div>
                        @endif

                        {{-- Actions --}}
                        <div class="user-actions">
                            <a href="/admin/users/{{ $user->id }}/edit" class="btn-action btn-edit">
                                ✏️ Edit
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="/admin/users/{{ $user->id }}" method="POST" style="flex: 1;" onsubmit="return confirm('⚠️ Yakin ingin menghapus user ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @else
                                <button disabled class="btn-action btn-delete">
                                    🗑️ Hapus
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- EMPTY STATE --}}
        <div class="empty-state">
            <div class="empty-icon">👥</div>
            <h3>Tidak Ada User</h3>
            <p>Belum ada user admin yang terdaftar.</p>
            <a href="/admin/users/create" class="btn btn-primary">
                + Tambah User Pertama
            </a>
        </div>
    @endif
</div>

@endsection