@extends($layout)

@section('title', 'Menu Navigasi - Admin')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
        <div>
            <h1 style="color: var(--primary, #1D3557); font-size: 26px; font-weight: 700; margin-bottom: 5px;">Menu Navigasi Website</h1>
            <p style="color: var(--text-light, #64748B); font-size: 14px;">Kelola struktur menu dan sub-menu website publik</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="/admin/dashboard" style="display: inline-flex; align-items: center; gap: 6px; background: white; color: var(--primary, #1D3557); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; border: 1px solid #E2E8F0; transition: 0.3s;">
                ← Dashboard
            </a>
            <a href="/admin/menus/create" style="display: inline-flex; align-items: center; gap: 6px; background: var(--primary, #1D3557); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.3s;">
                + Tambah Menu Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #DCFCE7; color: #166534; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #BBF7D0; border-left: 4px solid #22C55E; font-size: 14px; font-weight: 500;">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI INFO --}}
    <div style="background: #EFF6FF; color: #1E40AF; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #BFDBFE; font-size: 14px;">
        <strong>💡 Info:</strong> Menu dengan <strong>"Menu Induk"</strong> akan tampil sebagai <strong>dropdown/sub-menu</strong> di website. Atur <strong>Urutan</strong> untuk menentukan posisi menu.
    </div>

    {{-- STATISTIK SINGKAT --}}
    @php
        $totalMenu = $menus->count();
        $menuAktif = $menus->where('is_active', true)->count();
        $menuNonaktif = $totalMenu - $menuAktif;
    @endphp

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
        <div style="background: white; padding: 18px 22px; border-radius: 10px; border-left: 4px solid var(--primary, #1D3557); box-shadow: 0 2px 10px rgba(29, 53, 87, 0.05);">
            <div style="font-size: 12px; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Total Menu</div>
            <div style="font-size: 26px; font-weight: 800; color: var(--primary, #1D3557); margin-top: 5px;">{{ $totalMenu }}</div>
        </div>
        <div style="background: white; padding: 18px 22px; border-radius: 10px; border-left: 4px solid #10B981; box-shadow: 0 2px 10px rgba(29, 53, 87, 0.05);">
            <div style="font-size: 12px; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Menu Aktif</div>
            <div style="font-size: 26px; font-weight: 800; color: #10B981; margin-top: 5px;">{{ $menuAktif }}</div>
        </div>
        <div style="background: white; padding: 18px 22px; border-radius: 10px; border-left: 4px solid #F59E0B; box-shadow: 0 2px 10px rgba(29, 53, 87, 0.05);">
            <div style="font-size: 12px; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Menu Nonaktif</div>
            <div style="font-size: 26px; font-weight: 800; color: #F59E0B; margin-top: 5px;">{{ $menuNonaktif }}</div>
        </div>
    </div>

    {{-- KOLOM PENCARIAN --}}
    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(29, 53, 87, 0.05); margin-bottom: 25px; border: 1px solid #E2E8F0;">
        <form action="/admin/menus" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul menu atau URL..." style="flex: 1; min-width: 250px; padding: 12px 15px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 14px;">
            <button type="submit" style="background: var(--primary, #1D3557); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: 0.3s;">
                Cari
            </button>
            @if(request('search'))
                <a href="/admin/menus" style="background: #F1F5F9; color: #475569; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; border: 1px solid #E2E8F0; transition: 0.3s;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- DAFTAR MENU (HIERARKIS) --}}
    @if($menus->isNotEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(29, 53, 87, 0.06); overflow: hidden; border: 1px solid #E2E8F0;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                        <th style="padding: 15px; text-align: left; font-size: 12px; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Urutan</th>
                        <th style="padding: 15px; text-align: left; font-size: 12px; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Judul Menu</th>
                        <th style="padding: 15px; text-align: left; font-size: 12px; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">URL Tujuan</th>
                        <th style="padding: 15px; text-align: center; font-size: 12px; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="padding: 15px; text-align: center; font-size: 12px; color: #64748B; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr style="border-bottom: 1px solid #E2E8F0; transition: background 0.2s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                            <td style="padding: 15px; font-size: 14px; color: #1E293B; font-weight: 600;">{{ $menu->urutan }}</td>
                            <td style="padding: 15px;">
                                {{-- INDENTASI UNTUK SUB-MENU --}}
                                @if($menu->parent_id)
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span style="color: #94A3B8; font-size: 16px;">↳</span>
                                        <span style="font-size: 14px; color: #1E293B; font-weight: 500;">{{ $menu->judul_menu }}</span>
                                        <span style="background: #E0F2FE; color: #0369A1; padding: 2px 8px; border-radius: 50px; font-size: 10px; font-weight: 600;">Sub-menu</span>
                                    </div>
                                @else
                                    <span style="font-size: 14px; color: #1E293B; font-weight: 600;">{{ $menu->judul_menu }}</span>
                                @endif
                            </td>
                            <td style="padding: 15px;">
                                <code style="background: #F1F5F9; padding: 4px 8px; border-radius: 4px; font-size: 12px; color: #475569; word-break: break-all;">{{ $menu->url }}</code>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                @if($menu->is_active)
                                    <span style="background: #DCFCE7; color: #166534; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600;">● Aktif</span>
                                @else
                                    <span style="background: #FEE2E2; color: #991B1B; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600;">● Nonaktif</span>
                                @endif
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="/admin/menus/{{ $menu->id }}/edit" style="background: var(--primary, #1D3557); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: 0.3s;">
                                        ✏️ Edit
                                    </a>
                                    <form action="/admin/menus/{{ $menu->id }}" method="POST" style="display: inline;" onsubmit="return confirm('⚠️ Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #FEE2E2; color: #991B1B; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 12px; transition: 0.3s;" onmouseover="this.style.background='#FECACA'" onmouseout="this.style.background='#FEE2E2'">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        {{-- EMPTY STATE --}}
        <div style="background: white; padding: 60px 40px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(29, 53, 87, 0.06); border: 1px solid #E2E8F0;">
            <div style="font-size: 60px; margin-bottom: 15px;">🧭</div>
            <h3 style="color: var(--primary, #1D3557); font-size: 20px; margin-bottom: 10px;">Belum Ada Menu</h3>
            <p style="color: #64748B; font-size: 14px; margin-bottom: 25px;">Mulai tambahkan menu navigasi untuk website publik Anda.</p>
            <a href="/admin/menus/create" style="display: inline-flex; align-items: center; gap: 8px; background: var(--primary, #1D3557); color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s;">
                + Tambah Menu Pertama
            </a>
        </div>
    @endif
@endsection