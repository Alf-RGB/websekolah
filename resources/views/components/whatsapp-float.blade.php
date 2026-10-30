@php
    // 1. Ambil nomor dari database
    $wa = \App\Models\Setting::where('key', 'nomor_whatsapp')->first();
    $rawNumber = $wa ? $wa->value : '6281234567890';
    
    // 2. BERSIHKAN NOMOR: Hapus semua karakter selain angka (spasi, +, -, dll)
    $nomor = preg_replace('/[^0-9]/', '', $rawNumber);
    
    // 3. Pastikan dimulai dengan 62 (Kode Negara Indonesia). Jika mulai dengan 0, ganti jadi 62
    if (str_starts_with($nomor, '0')) {
        $nomor = '62' . substr($nomor, 1);
    }
    
    // 4. Buat pesan template otomatis (URL Encoded)
    $pesan = urlencode("Halo Admin, saya ingin bertanya mengenai informasi sekolah.");
@endphp

<a href="https://wa.me/{{ $nomor }}?text={{ $pesan }}" 
   target="_blank" a@php
    // 1. Ambil nomor dari database
    $wa = \App\Models\Setting::where('key', 'nomor_whatsapp')->first();
    $rawNumber = $wa ? $wa->value : '6281234567890';
    
    // 2. BERSIHKAN NOMOR: Hapus semua karakter selain angka (spasi, +, -, dll)
    $nomor = preg_replace('/[^0-9]/', '', $rawNumber);
    
    // 3. Pastikan dimulai dengan 62 (Kode Negara Indonesia). Jika mulai dengan 0, ganti jadi 62
    if (str_starts_with($nomor, '0')) {
        $nomor = '62' . substr($nomor, 1);
    }
    
    // 4. Buat pesan template otomatis (URL Encoded)
    $pesan = urlencode("Halo Admin, saya ingin bertanya mengenai informasi sekolah.");
@endphp

<style>
    /* =========================================
       ANIMATIONS
       ========================================= */
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100px) scale(0.8); }
        to { opacity: 1; transform: translateX(0) scale(1); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    @keyframes ripple {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    @keyframes pulse {
        0%, 100% { box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4); }
        50% { box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7), 0 0 0 10px rgba(37, 211, 102, 0.1); }
    }

    /* =========================================
       WHATSAPP FLOATING BUTTON
       ========================================= */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        z-index: 9999;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: 
            slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.5s backwards,
            float 3s ease-in-out infinite,
            pulse 2s ease-in-out infinite;
        text-decoration: none;
        cursor: pointer;
        overflow: hidden;
    }

    .whatsapp-float::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: inherit;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .whatsapp-float:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow: 0 12px 35px rgba(37, 211, 102, 0.6);
        animation: float 3s ease-in-out infinite; /* Keep floating but scale up */
    }

    .whatsapp-float:hover::before {
        opacity: 0.1;
    }

    .whatsapp-float:active {
        transform: scale(0.95);
        animation: ripple 0.4s ease-out;
    }

    .whatsapp-float svg {
        width: 32px;
        height: 32px;
        fill: white;
        position: relative;
        z-index: 1;
        transition: transform 0.3s;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    .whatsapp-float:hover svg {
        transform: scale(1.1);
    }

    /* Tooltip Styling */
    .wa-tooltip {
        position: absolute;
        right: 75px;
        background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
        color: white;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transform: translateX(15px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3);
        z-index: 10;
    }

    /* Panah kecil pada tooltip */
    .wa-tooltip::after {
        content: '';
        position: absolute;
        right: -8px;
        top: 50%;
        transform: translateY(-50%);
        border-width: 8px;
        border-style: solid;
        border-color: transparent transparent transparent #1D3557;
        filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
    }

    .whatsapp-float:hover .wa-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    /* Badge Notifikasi (Opsional - bisa ditambah nanti) */
    .wa-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: #EF4444;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }

    /* =========================================
       RESPONSIVE: Penyesuaian untuk Layar HP
       ========================================= */
    @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
            width: 55px;
            height: 55px;
            animation: 
                slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.5s backwards,
                float 3s ease-in-out infinite;
        }
        .whatsapp-float svg {
            width: 28px;
            height: 28px;
        }
        .wa-tooltip {
            display: none; /* Sembunyikan tooltip di HP untuk menghemat ruang layar */
        }
    }

    @media (max-width: 480px) {
        .whatsapp-float {
            bottom: 15px;
            right: 15px;
            width: 50px;
            height: 50px;
        }
        .whatsapp-float svg {
            width: 26px;
            height: 26px;
        }
    }

    /* =========================================
       DARK MODE (Optional)
       ========================================= */
    [data-theme="dark"] .wa-tooltip {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    }
    [data-theme="dark"] .wa-tooltip::after {
        border-color: transparent transparent transparent #0F172A;
    }
</style>

<a href="https://wa.me/{{ $nomor }}?text={{ $pesan }}" 
   target="_blank" 
   rel="noopener noreferrer" 
   class="whatsapp-float" 
   aria-label="Chat dengan kami via WhatsApp"
   title="Chat via WhatsApp">
    
    {{-- Tooltip yang muncul saat hover --}}
    <span class="wa-tooltip"> Chat dengan Kami</span>
    
    {{-- Ikon WhatsApp --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>

    {{-- Badge Notifikasi (Opsional - Uncomment jika butuh) --}}
    {{-- <span class="wa-badge">3</span> --}}
</a>
   rel="noopener noreferrer" 
   class="whatsapp-float" 
   aria-label="Chat dengan kami via WhatsApp"
   title="Chat via WhatsApp">
    
    {{-- Tooltip yang muncul saat hover --}}
    <span class="wa-tooltip">Chat dengan Kami</span>
    
    {{-- Ikon WhatsApp --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="white">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

<style>
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #25D366;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        z-index: 9999;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: pulse 2s infinite;
        text-decoration: none;
    }
    
    /* Tooltip Styling */
    .wa-tooltip {
        position: absolute;
        right: 75px;
        background: #1D3557;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transform: translateX(10px);
        transition: all 0.3s ease;
        pointer-events: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    /* Panah kecil pada tooltip */
    .wa-tooltip::after {
        content: '';
        position: absolute;
        right: -6px;
        top: 50%;
        transform: translateY(-50%);
        border-width: 6px;
        border-style: solid;
        border-color: transparent transparent transparent #1D3557;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.6);
        animation: none; /* Hentikan pulse saat di-hover agar fokus */
    }
    
    .whatsapp-float:hover .wa-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4); }
        50% { box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7); }
        100% { box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4); }
    }

    /* RESPONSIVE: Penyesuaian untuk Layar HP */
    @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
            width: 55px;
            height: 55px;
        }
        .whatsapp-float svg {
            width: 28px;
            height: 28px;
        }
        .wa-tooltip {
            display: none; /* Sembunyikan tooltip di HP untuk menghemat ruang layar */
        }
    }
</style>