

<?php $__env->startSection('title', 'Lamaran Guru Masuk'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================
       ANIMATIONS - SMOOTH & PROFESSIONAL
       ========================================= */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .lamaran-wrapper { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    .lamaran-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px; 
        padding: 35px 40px; 
        margin-bottom: 30px;
        position: relative; 
        overflow: hidden; 
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        animation: fadeInDown 0.8s ease;
    }
    .lamaran-header::before { 
        content: ''; 
        position: absolute; 
        top: -50%; 
        right: -20%; 
        width: 400px; 
        height: 400px; 
        background: rgba(255,255,255,0.1); 
        border-radius: 50%; 
    }
    .header-content { position: relative; z-index: 1; }
    .header-title { 
        font-size: 32px; 
        font-weight: 800; 
        color: white; 
        margin: 0 0 10px 0; 
        letter-spacing: -0.5px; 
    }
    .header-subtitle { 
        font-size: 16px; 
        color: rgba(255,255,255,0.9); 
        margin: 0 0 20px 0; 
    }
    .header-note {
        background: rgba(255,255,255,0.15); 
        backdrop-filter: blur(10px); 
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 12px; 
        padding: 15px 20px; 
        display: flex; 
        align-items: flex-start; 
        gap: 12px; 
        margin-top: 20px;
        animation: fadeInUp 0.6s ease 0.2s both;
    }
    .header-note-icon { width: 24px; height: 24px; flex-shrink: 0; color: #FDE047; }
    .header-note-text { font-size: 14px; color: white; line-height: 1.6; margin: 0; }

    /* STAT CARDS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg, white);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid var(--border-color, #E2E8F0);
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 4px solid;
        animation: fadeInUp 0.6s ease backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card.total { border-left-color: #667eea; }
    .stat-card.pending { border-left-color: #F59E0B; }
    .stat-card.accepted { border-left-color: #10B981; }
    .stat-card.rejected { border-left-color: #EF4444; }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-label {
        font-size: 12px;
        color: var(--text-secondary, #64748B);
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary, #1E293B);
        margin: 0;
        line-height: 1;
    }

    /* Search & Content */
    .search-container {
        background: var(--card-bg, white); 
        border-radius: 16px; 
        padding: 20px 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        border: 1px solid var(--border-color, #E2E8F0); 
        margin-bottom: 30px;
        animation: fadeInUp 0.6s ease 0.4s both;
    }
    .search-form { display: flex; gap: 15px; align-items: center; }
    .search-input-wrapper { flex: 1; position: relative; }
    .search-icon {
        position: absolute !important; 
        left: 15px !important; 
        top: 50% !important;
        transform: translateY(-50%) !important; 
        width: 18px !important; 
        height: 18px !important;
        color: #94A3B8 !important; 
        pointer-events: none !important; 
        z-index: 10 !important;
    }
    .search-input {
        width: 100% !important; 
        padding: 12px 16px 12px 45px !important;
        border: 2px solid var(--border-color, #E2E8F0) !important; 
        border-radius: 12px !important;
        font-size: 14px !important; 
        background: var(--input-bg, #F8FAFC) !important;
        color: var(--text-primary, #1E293B) !important; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important; 
        box-sizing: border-box !important;
    }
    .search-input:focus { 
        outline: none !important; 
        border-color: #667eea !important; 
        background: white !important; 
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1) !important;
        transform: translateY(-2px) !important;
    }
    .search-input::placeholder { color: #94A3B8 !important; opacity: 1 !important; }
    
    .btn-search {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
        color: white !important; 
        border: none;
        padding: 12px 28px; 
        border-radius: 12px; 
        font-weight: 700; 
        font-size: 14px; 
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        white-space: nowrap; 
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .btn-search:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4); 
    }

    .content-card { 
        background: var(--card-bg, white); 
        border-radius: 20px; 
        padding: 30px; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        border: 1px solid var(--border-color, #E2E8F0); 
        animation: slideIn 0.6s ease 0.5s both;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%); 
        border: 2px solid #10B981; 
        border-radius: 12px;
        padding: 15px 20px; 
        margin-bottom: 20px; 
        display: flex; 
        align-items: center; 
        gap: 10px; 
        animation: fadeInDown 0.5s ease;
    }
    .alert-success svg { width: 20px; height: 20px; color: #065F46; flex-shrink: 0; }
    .alert-success span { color: #065F46; font-weight: 600; font-size: 14px; }
    
    .table-container { overflow-x: auto; }
    .table-lamaran { width: 100%; border-collapse: collapse; font-size: 14px; }
    .table-lamaran thead tr { background: var(--bg-tertiary, #F8FAFC); border-bottom: 2px solid var(--border-color, #E2E8F0); }
    .table-lamaran th { padding: 12px 15px; color: var(--text-secondary, #64748B); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; }
    
    .table-lamaran tbody tr { 
        border-bottom: 1px solid var(--border-color, #E2E8F0); 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInLeft 0.5s ease backwards;
    }
    .table-lamaran tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table-lamaran tbody tr:nth-child(2) { animation-delay: 0.15s; }
    .table-lamaran tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .table-lamaran tbody tr:nth-child(4) { animation-delay: 0.25s; }
    .table-lamaran tbody tr:nth-child(5) { animation-delay: 0.3s; }
    
    .table-lamaran tbody tr:hover { 
        background: var(--bg-tertiary, #F8FAFC); 
        transform: translateX(5px);
    }
    .table-lamaran td { padding: 12px 15px; color: var(--text-primary, #1E293B); vertical-align: middle; }

    .status-badge { 
        display: inline-block; 
        padding: 4px 12px; 
        border-radius: 12px; 
        font-size: 11px; 
        font-weight: 700; 
        color: white; 
        text-align: center; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .status-badge:hover { transform: scale(1.05); }
    .status-pending { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
    .status-diterima { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    .status-ditolak { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }

    .action-buttons { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
    .btn-action {
        padding: 6px 12px; 
        border-radius: 8px; 
        border: none; 
        cursor: pointer;
        font-size: 12px; 
        font-weight: 700; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 6px rgba(0,0,0,0.2); 
        color: white !important;
    }
    .btn-action:hover { 
        transform: translateY(-3px) scale(1.05); 
        box-shadow: 0 6px 15px rgba(0,0,0,0.3); 
    }
    .btn-surat { background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%) !important; }
    .btn-terima { background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important; }
    .btn-tolak { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important; }
    .btn-ubah { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%) !important; }

    /* Modals */
    .modal-overlay {
        display: none; 
        position: fixed; 
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.4); 
        backdrop-filter: blur(4px); 
        z-index: 9999;
        align-items: center; 
        justify-content: center; 
        padding: 20px;
    }
    .modal-content {
        background: var(--card-bg, white); 
        border-radius: 24px; 
        padding: 0; 
        max-width: 900px; 
        width: 100%;
        max-height: 90vh; 
        overflow: hidden; 
        box-shadow: 0 25px 100px rgba(0,0,0,0.3);
        animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color, rgba(255,255,255,0.1));
    }
    
    .modal-header {
        padding: 14px 25px !important;
        border-bottom: 2px solid var(--border-color, #E2E8F0);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header-left { display: flex; align-items: center; gap: 12px !important; }
    .modal-icon {
        width: 40px !important; height: 40px !important; border-radius: 10px !important;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3) !important; flex-shrink: 0;
    }
    .modal-icon svg { width: 20px !important; height: 20px !important; color: white; }
    .modal-header h2 { color: var(--text-primary, #1E293B); font-size: 17px !important; font-weight: 800; margin: 0 0 2px 0 !important; line-height: 1.2 !important; }
    .modal-header p { color: var(--text-secondary, #64748B); font-size: 11px !important; margin: 0 !important; line-height: 1.3 !important; }

    .btn-copy-header, .btn-close-modal {
        width: 40px !important; height: 40px !important; min-width: 40px !important;
        min-height: 40px !important; max-width: 40px !important; max-height: 40px !important;
        border-radius: 10px !important; border: none !important; cursor: pointer !important;
        display: inline-flex !important; align-items: center !important; justify-content: center !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important; flex-shrink: 0 !important;
        background: rgba(241, 245, 249, 0.9) !important; color: #64748B !important;
        font-size: 18px !important; font-weight: 600 !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }
    .btn-copy-header:hover {
        background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%) !important;
        color: #FFFFFF !important; transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4) !important;
    }
    .btn-close-modal:hover {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        color: #FFFFFF !important; transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
    }
    .btn-copy-header.copied {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: #FFFFFF !important; transform: scale(1.1) !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4) !important;
    }

    .modal-body { padding: 20px 25px !important; overflow-y: auto; max-height: calc(90vh - 120px); }
    .surat-container {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%); border: 2px solid #A5B4FC;
        border-radius: 16px; padding: 18px !important; margin-bottom: 15px !important;
    }
    .surat-label { display: block; font-size: 13px !important; font-weight: 700; color: #3730A3; margin-bottom: 10px !important; }
    .surat-container-inner {
        background: white; border: 1px solid #A5B4FC; border-radius: 12px; padding: 18px !important;
        box-shadow: inset 0 2px 8px rgba(0,0,0,0.05);
    }
    #draftSuratPreview {
        width: 100%; border: none; background: transparent; color: #1E293B;
        font-size: 13px !important; line-height: 1.7 !important; resize: none; font-family: 'Georgia', serif;
        min-height: 320px !important; outline: none;
    }

    .empty-state { text-align: center; padding: 60px 20px; animation: fadeInUp 0.6s ease; }
    .empty-icon-wrapper { 
        width: 120px; height: 120px; margin: 0 auto 25px; 
        background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%); 
        border-radius: 50%; display: flex; align-items: center; justify-content: center; 
        animation: pulse 2s ease infinite;
    }
    .empty-icon { width: 60px; height: 60px; color: #9CA3AF; }
    .empty-title { font-size: 24px; font-weight: 700; color: var(--text-primary, #1E293B); margin: 0 0 10px 0; }
    .empty-text { font-size: 15px; color: var(--text-secondary, #64748B); margin: 0; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6; }
    
    .btn-reset-search {
        display: inline-block; margin-top: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .btn-reset-search:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4); }

    /* Konfirmasi Modal */
    .konfirmasi-card {
        background: var(--card-bg, white); border-radius: 20px; padding: 35px; max-width: 450px; width: 100%;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3); animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color, rgba(255,255,255,0.1)); text-align: center;
    }
    .konfirmasi-icon {
        width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
    }
    .konfirmasi-icon.warning { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4); }
    .konfirmasi-icon.danger { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4); }
    .konfirmasi-icon.success { background: linear-gradient(135deg, #10B981 0%, #059669 100%); box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); }
    .konfirmasi-icon svg { width: 35px; height: 35px; color: white; }
    
    .konfirmasi-title { font-size: 22px; font-weight: 800; color: var(--text-primary, #1E293B); margin: 0 0 12px 0; letter-spacing: -0.5px; }
    .konfirmasi-message { font-size: 15px; color: var(--text-secondary, #64748B); margin: 0 0 30px 0; line-height: 1.6; }
    .konfirmasi-message strong { color: var(--text-primary, #1E293B); font-weight: 700; }
    .konfirmasi-buttons { display: flex; gap: 12px; justify-content: center; }
    
    .btn-konfirmasi { 
        padding: 12px 28px; border-radius: 12px; border: none; font-size: 14px; font-weight: 700; 
        cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); min-width: 120px; 
    }
    .btn-konfirmasi-batal { background: var(--bg-tertiary, #F1F5F9); color: var(--text-primary, #475569); border: 2px solid var(--border-color, #CBD5E1); }
    .btn-konfirmasi-batal:hover { background: var(--border-color, #E2E8F0); transform: translateY(-2px); }
    .btn-konfirmasi-ya { color: white; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); }
    .btn-konfirmasi-ya:hover { transform: translateY(-2px); }
    .btn-konfirmasi-ya.warning { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4); }
    .btn-konfirmasi-ya.warning:hover { box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5); }
    .btn-konfirmasi-ya.danger { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4); }
    .btn-konfirmasi-ya.danger:hover { box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5); }
    .btn-konfirmasi-ya.success { background: linear-gradient(135deg, #10B981 0%, #059669 100%); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); }
    .btn-konfirmasi-ya.success:hover { box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5); }

    /* Dark Mode Global */
    [data-theme="dark"] .lamaran-header { background: linear-gradient(135deg, #4C1D95 0%, #5B21B6 100%) !important; }
    [data-theme="dark"] .stat-card, [data-theme="dark"] .search-container, [data-theme="dark"] .content-card, [data-theme="dark"] .modal-content, [data-theme="dark"] .konfirmasi-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .stat-value, [data-theme="dark"] .empty-title, [data-theme="dark"] .modal-header h2, [data-theme="dark"] #draftSuratPreview, [data-theme="dark"] .konfirmasi-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .stat-label, [data-theme="dark"] .empty-text, [data-theme="dark"] .modal-header p, [data-theme="dark"] .konfirmasi-message { color: #94A3B8 !important; }
    [data-theme="dark"] .search-input { background: #0F172A !important; border-color: #334155 !important; color: #F1F5F9 !important; }
    [data-theme="dark"] .search-input:focus { background: #1E293B !important; border-color: #667eea !important; }
    [data-theme="dark"] .empty-icon-wrapper { background: linear-gradient(135deg, #1E293B 0%, #334155 100%) !important; }
    [data-theme="dark"] .empty-icon { color: #64748B !important; }
    [data-theme="dark"] .btn-search, [data-theme="dark"] .btn-reset-search { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; color: white !important; }
    [data-theme="dark"] .surat-container { background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%) !important; border-color: #4338CA !important; }
    [data-theme="dark"] .surat-container-inner { background: #0F172A !important; border-color: #4338CA !important; }
    [data-theme="dark"] .table-lamaran thead tr, [data-theme="dark"] .table-lamaran tbody tr:hover { background: #0F172A !important; }
    [data-theme="dark"] .btn-copy-header, [data-theme="dark"] .btn-close-modal { background: #334155 !important; color: #CBD5E1 !important; }
    [data-theme="dark"] .btn-copy-header:hover { background: linear-gradient(135deg, #818CF8 0%, #A78BFA 100%) !important; color: white !important; }
    [data-theme="dark"] .btn-close-modal:hover { background: linear-gradient(135deg, #F87171 0%, #EF4444 100%) !important; color: white !important; }
    [data-theme="dark"] .btn-konfirmasi-batal { background: #334155 !important; color: #F1F5F9 !important; border-color: #475569 !important; }
    [data-theme="dark"] .btn-konfirmasi-batal:hover { background: #475569 !important; }
    [data-theme="dark"] .btn-surat { background: linear-gradient(135deg, #818CF8 0%, #A78BFA 100%) !important; }
    [data-theme="dark"] .btn-terima { background: linear-gradient(135deg, #34D399 0%, #10B981 100%) !important; }
    [data-theme="dark"] .btn-tolak { background: linear-gradient(135deg, #F87171 0%, #EF4444 100%) !important; }
    [data-theme="dark"] .btn-ubah { background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%) !important; }

    @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { 
        .lamaran-wrapper { padding: 20px; }
        .lamaran-header { padding: 25px 20px; }
        .header-title { font-size: 24px; }
        .stats-grid { grid-template-columns: 1fr; }
        .search-form { flex-direction: column; }
        .btn-search { width: 100%; }
        .content-card { padding: 20px; }
        .action-buttons { flex-direction: column; }
        .btn-action { width: 100%; }
        .konfirmasi-card { padding: 25px 20px; }
        .konfirmasi-buttons { flex-direction: column; }
        .btn-konfirmasi { width: 100%; }
    }
</style>

<div class="lamaran-wrapper">

    <div class="lamaran-header">
        <div class="header-content">
            <h1 class="header-title">Lamaran Guru Masuk</h1>
            <p class="header-subtitle">Kelola dan seleksi lamaran kerja guru yang masuk</p>
            <div class="header-note">
                <svg class="header-note-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="header-note-text">
                    <strong>Catatan Penting:</strong> Jika status diubah menjadi "Diterima", jangan lupa untuk membuatkan akun login guru di menu "Kelola Guru" agar mereka bisa mengakses Portal Akademik.
                </p>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card total">
            <div class="stat-label">Total Lamaran</div>
            <div class="stat-value"><?php echo e($totalLamaran ?? 0); ?></div>
        </div>
        <div class="stat-card pending">
            <div class="stat-label">Pending Review</div>
            <div class="stat-value"><?php echo e($pendingLamaran ?? 0); ?></div>
        </div>
        <div class="stat-card accepted">
            <div class="stat-label">Diterima</div>
            <div class="stat-value"><?php echo e($acceptedLamaran ?? 0); ?></div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-label">Ditolak</div>
            <div class="stat-value"><?php echo e($rejectedLamaran ?? 0); ?></div>
        </div>
    </div>

    <div class="search-container">
        <form method="GET" action="<?php echo e(route('admin.lamaran.index')); ?>" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" class="search-input" placeholder="Cari nama pelamar atau mata pelajaran..." value="<?php echo e(request('search')); ?>">
            </div>
            <button type="submit" class="btn-search">Cari</button>
        </form>
    </div>

    <div class="content-card">
        <?php if(session('success')): ?>
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(isset($lamarans) && $lamarans->count() > 0): ?>
            <div class="table-container">
                <table class="table-lamaran">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Nama & Pendidikan</th>
                            <th style="text-align: center;">Kontak</th>
                            <th style="text-align: center;">Mapel Dilamar</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $lamarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lamaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div style="font-weight: 600;"><?php echo e($lamaran->nama_lengkap); ?></div>
                                <div style="font-size: 12px; color: var(--text-secondary, #64748B);"><?php echo e($lamaran->pendidikan_terakhir); ?></div>
                            </td>
                            <td>
                                <div><?php echo e($lamaran->email); ?></div>
                                <div style="font-size: 12px; color: var(--text-secondary, #64748B);"><?php echo e($lamaran->no_hp); ?></div>
                            </td>
                            <td><?php echo e($lamaran->mata_pelajaran_diinginkan); ?></td>
                            <td style="text-align: center;">
                                <span class="status-badge status-<?php echo e($lamaran->status); ?>"><?php echo e(ucfirst($lamaran->status)); ?></span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-buttons">
                                    <?php if($lamaran->status === 'pending'): ?>
                                        <button onclick="terimaLamaran(<?php echo e($lamaran->id); ?>, '<?php echo e($lamaran->nama_lengkap); ?>')" class="btn-action btn-terima">✓ Terima</button>
                                        <button onclick="tolakLamaran(<?php echo e($lamaran->id); ?>, '<?php echo e($lamaran->nama_lengkap); ?>')" class="btn-action btn-tolak">✗ Tolak</button>
                                    <?php elseif($lamaran->status === 'diterima'): ?>
                                        <button onclick="ubahStatus(<?php echo e($lamaran->id); ?>, 'ditolak', '<?php echo e($lamaran->nama_lengkap); ?>')" class="btn-action btn-ubah">Ubah Status</button>
                                    <?php elseif($lamaran->status === 'ditolak'): ?>
                                        <button onclick="ubahStatus(<?php echo e($lamaran->id); ?>, 'diterima', '<?php echo e($lamaran->nama_lengkap); ?>')" class="btn-action btn-terima">Ubah Status</button>
                                    <?php endif; ?>
                                    <button onclick="openSuratModal(<?php echo e($lamaran->id); ?>, '<?php echo e($lamaran->nama_lengkap); ?>', '<?php echo e($lamaran->status); ?>')" class="btn-action btn-surat">Surat</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(method_exists($lamarans, 'links')): ?>
                <div style="margin-top: 25px; animation: fadeInUp 0.5s ease 0.6s both;"><?php echo e($lamarans->links()); ?></div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon-wrapper">
                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="empty-title">Belum Ada Lamaran</h3>
                <p class="empty-text">Belum ada lamaran kerja guru yang masuk.</p>
                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('admin.lamaran.index')); ?>" class="btn-reset-search">Tampilkan Semua Lamaran</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div id="modalSurat" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-left">
                    <div class="modal-icon" id="modalIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 id="modalTitle">Template Surat</h2>
                        <p id="modalSubtitle">Preview & salin surat untuk pelamar</p>
                    </div>
                </div>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <button onclick="copySuratPreview()" id="btnCopyHeader" class="btn-copy-header" type="button" title="Salin Surat">
                        <span id="copySymbol" style="font-size:18px;line-height:1;color:inherit;pointer-events:none;">⧉</span>
                        <span id="checkSymbol" style="font-size:18px;line-height:1;color:inherit;pointer-events:none;display:none;">✓</span>
                    </button>
                    <button onclick="closeSuratModal()" id="btnCloseModal" class="btn-close-modal" type="button" title="Tutup">×</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="surat-container">
                    <label class="surat-label">📄 Draft Surat</label>
                    <div class="surat-container-inner">
                        <textarea id="draftSuratPreview" rows="15" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalKonfirmasi" class="modal-overlay">
        <div class="konfirmasi-card">
            <div class="konfirmasi-icon" id="konfirmasiIcon">
                <svg id="konfirmasiIconSvg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="konfirmasi-title" id="konfirmasiTitle">Konfirmasi</h3>
            <p class="konfirmasi-message" id="konfirmasiMessage">Apakah Anda yakin?</p>
            <div class="konfirmasi-buttons">
                <button class="btn-konfirmasi btn-konfirmasi-batal" onclick="closeKonfirmasi()">Batal</button>
                <button class="btn-konfirmasi btn-konfirmasi-ya" id="btnKonfirmasiYa">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

</div>

<script>
let currentLamaranId = null;
let pendingAction = null;

const templateDiterima = (nama) => `Yth. Sdr. ${nama}\nDi Tempat\n\nDengan hormat,\n\nBerdasarkan hasil seleksi administrasi dan wawancara yang telah kami lakukan, dengan ini kami sampaikan bahwa Saudara/i dinyatakan DITERIMA untuk bergabung sebagai Guru di SMK Multi Karya Medan.\n\nSehubungan dengan hal tersebut, kami mengundang Saudara/i untuk hadir dalam tahap selanjutnya yaitu:\n\nHari/Tanggal : [HARI/TANGGAL]\nWaktu        : [JAM]\nTempat       : SMK Multi Karya Medan\n             Jl. Multi Karya No. 123, Medan\n\nAgar Saudara/i dapat hadir tepat waktu dan membawa:\n1. Fotokopi Ijazah dan Transkrip Nilai (legalisir)\n2. Fotokopi KTP\n3. Pas foto terbaru 3x4 (2 lembar)\n4. Surat Keterangan Catatan Kepolisian (SKCK)\n5. Surat Keterangan Sehat dari Dokter\n6. CV/Daftar Riwayat Hidup\n7. Sertifikat pendukung (jika ada)\n\nKami mengucapkan selamat dan berharap Saudara/i dapat menjadi bagian dari tim pendidik kami untuk mencerdaskan generasi bangsa.\n\nDemikian surat ini kami sampaikan. Atas perhatian dan kerja sama Saudara/i, kami ucapkan terima kasih.\n\nHormat kami,\nKepala SMK Multi Karya Medan\n\n\n(.....................................)\nNIP. ...........................`;

const templateDitolak = (nama) => `Yth. Sdr. ${nama}\nDi Tempat\n\nDengan hormat,\n\nTerima kasih atas minat dan kepercayaan Saudara/i untuk bergabung sebagai Guru di SMK Multi Karya Medan. Kami telah menerima dan meninjau lamaran kerja yang Saudara/i kirimkan.\n\nSetelah melalui proses seleksi yang ketat dan mempertimbangkan berbagai faktor, dengan berat hati kami sampaikan bahwa pada saat ini kami belum dapat menerima lamaran Saudara/i.\n\nKeputusan ini bukan berarti mengurangi apresiasi kami terhadap kualifikasi dan pengalaman yang Saudara/i miliki. Kami sangat menghargai waktu dan usaha yang telah Saudara/i luangkan untuk mengikuti proses seleksi ini.\n\nKami akan menyimpan data Saudara/i dalam database kami, dan apabila di kemudian hari terdapat posisi yang sesuai dengan kualifikasi Saudara/i, kami tidak akan ragu untuk menghubungi kembali.\n\nKami mengucapkan terima kasih atas minat Saudara/i terhadap SMK Multi Karya Medan dan semoga sukses dalam pencarian pekerjaan selanjutnya.\n\nHormat kami,\nKepala SMK Multi Karya Medan\n\n\n(.....................................)\nNIP. ...........................`;

function openSuratModal(id, nama, status) {
    currentLamaranId = id;
    const modal = document.getElementById('modalSurat');
    const textarea = document.getElementById('draftSuratPreview');
    const modalIcon = document.getElementById('modalIcon');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubtitle = document.getElementById('modalSubtitle');
    
    if (status === 'diterima') {
        textarea.value = templateDiterima(nama);
        modalIcon.style.background = 'linear-gradient(135deg, #10B981 0%, #059669 100%)';
        modalTitle.textContent = 'Surat Penerimaan';
        modalSubtitle.textContent = 'Surat untuk pelamar yang diterima';
    } else if (status === 'ditolak') {
        textarea.value = templateDitolak(nama);
        modalIcon.style.background = 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)';
        modalTitle.textContent = 'Surat Penolakan';
        modalSubtitle.textContent = 'Surat untuk pelamar yang ditolak';
    } else {
        textarea.value = templateDiterima(nama);
        modalIcon.style.background = 'linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%)';
        modalTitle.textContent = 'Template Surat';
        modalSubtitle.textContent = 'Preview surat untuk pelamar';
    }
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeSuratModal() {
    document.getElementById('modalSurat').style.display = 'none';
    document.body.style.overflow = 'auto';
    currentLamaranId = null;
}

function copySuratPreview() {
    const textarea = document.getElementById('draftSuratPreview');
    textarea.select();
    document.execCommand('copy');
    
    const btnCopy = document.getElementById('btnCopyHeader');
    const copySymbol = document.getElementById('copySymbol');
    const checkSymbol = document.getElementById('checkSymbol');
    
    if (copySymbol && checkSymbol && btnCopy) {
        copySymbol.style.display = 'none';
        checkSymbol.style.display = 'block';
        btnCopy.classList.add('copied');
        setTimeout(function() {
            copySymbol.style.display = 'block';
            checkSymbol.style.display = 'none';
            btnCopy.classList.remove('copied');
        }, 2000);
    }
}

function showKonfirmasi(title, message, onConfirm, type = 'warning') {
    const modal = document.getElementById('modalKonfirmasi');
    const icon = document.getElementById('konfirmasiIcon');
    const iconSvg = document.getElementById('konfirmasiIconSvg');
    const titleEl = document.getElementById('konfirmasiTitle');
    const messageEl = document.getElementById('konfirmasiMessage');
    const btnYa = document.getElementById('btnKonfirmasiYa');
    
    titleEl.textContent = title;
    messageEl.innerHTML = message;
    icon.className = 'konfirmasi-icon';
    btnYa.className = 'btn-konfirmasi btn-konfirmasi-ya';
    
    if (type === 'danger') {
        icon.classList.add('danger');
        btnYa.classList.add('danger');
        iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
    } else if (type === 'success') {
        icon.classList.add('success');
        btnYa.classList.add('success');
        iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
    } else {
        icon.classList.add('warning');
        btnYa.classList.add('warning');
        iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />';
    }
    pendingAction = onConfirm;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeKonfirmasi() {
    document.getElementById('modalKonfirmasi').style.display = 'none';
    document.body.style.overflow = 'auto';
    pendingAction = null;
}

function executeKonfirmasi() {
    if (pendingAction) pendingAction();
    closeKonfirmasi();
}

document.getElementById('btnKonfirmasiYa').addEventListener('click', executeKonfirmasi);

function terimaLamaran(id, nama) {
    showKonfirmasi('Terima Lamaran', 'Terima lamaran dari <strong>' + nama + '</strong>?<br>Status akan diubah menjadi <strong style="color:#10B981;">Diterima</strong>.', function() { submitForm(id, 'diterima'); }, 'success');
}

function tolakLamaran(id, nama) {
    showKonfirmasi('Tolak Lamaran', 'Tolak lamaran dari <strong>' + nama + '</strong>?<br>Status akan diubah menjadi <strong style="color:#EF4444;">Ditolak</strong>.', function() { submitForm(id, 'ditolak'); }, 'danger');
}

function ubahStatus(id, newStatus, nama) {
    const statusLabel = newStatus === 'diterima' ? 'DITERIMA' : 'DITOLAK';
    const statusColor = newStatus === 'diterima' ? '#10B981' : '#EF4444';
    const type = newStatus === 'diterima' ? 'success' : 'danger';
    showKonfirmasi('Ubah Status', 'Ubah status <strong>' + nama + '</strong> menjadi <strong style="color:' + statusColor + ';">' + statusLabel + '</strong>?', function() { submitForm(id, newStatus); }, type);
}

function submitForm(id, status) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/lamaran/' + id + '/update-status';
    form.innerHTML = '<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="status" value="' + status + '">';
    document.body.appendChild(form);
    form.submit();
}

document.getElementById('modalSurat').addEventListener('click', function(e) { if (e.target === this) closeSuratModal(); });
document.getElementById('modalKonfirmasi').addEventListener('click', function(e) { if (e.target === this) closeKonfirmasi(); });

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.keyCode === 27) {
        const modalKonfirmasi = document.getElementById('modalKonfirmasi');
        const modalSurat = document.getElementById('modalSurat');
        if (modalKonfirmasi && modalKonfirmasi.style.display === 'flex') closeKonfirmasi();
        else if (modalSurat && modalSurat.style.display === 'flex') closeSuratModal();
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/lamaran/index.blade.php ENDPATH**/ ?>