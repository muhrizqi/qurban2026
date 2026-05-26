<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Playback History - Progress Report Qurban 1447H</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Dark Mode variables */
        body.theme-mode-dark {
            --bg-color: #090d16;
            --card-bg: rgba(17, 24, 39, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --text-gold: #f59e0b;
        }

        /* Light Mode variables */
        body.theme-mode-light {
            --bg-color: #f1f5f9;
            --card-bg: rgba(255, 255, 255, 0.85);
            --card-border: rgba(15, 23, 42, 0.08);
            --text-main: #0f172a;
            --text-muted: #475569;
            --text-gold: #d97706;
        }

        /* Preset themes mapping to CSS custom properties */
        .theme-emerald {
            --theme-color: #10b981;
            --theme-color-rgb: 16, 185, 129;
            --theme-gradient: linear-gradient(135deg, #10b981, #059669);
        }
        .theme-indigo {
            --theme-color: #6366f1;
            --theme-color-rgb: 99, 102, 241;
            --theme-gradient: linear-gradient(135deg, #6366f1, #4f46e5);
        }
        .theme-violet {
            --theme-color: #8b5cf6;
            --theme-color-rgb: 139, 92, 246;
            --theme-gradient: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }
        .theme-rose {
            --theme-color: #f43f5e;
            --theme-color-rgb: 244, 63, 94;
            --theme-gradient: linear-gradient(135deg, #f43f5e, #e11d48);
        }
        .theme-amber {
            --theme-color: #f59e0b;
            --theme-color-rgb: 245, 158, 11;
            --theme-gradient: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .theme-sky {
            --theme-color: #0ea5e9;
            --theme-color-rgb: 14, 165, 233;
            --theme-gradient: linear-gradient(135deg, #0ea5e9, #0284c7);
        }
        .theme-teal {
            --theme-color: #14b8a6;
            --theme-color-rgb: 20, 184, 166;
            --theme-gradient: linear-gradient(135deg, #14b8a6, #0d9488);
        }
        .theme-fuchsia {
            --theme-color: #d946ef;
            --theme-color-rgb: 217, 70, 239;
            --theme-gradient: linear-gradient(135deg, #d946ef, #c026d3);
        }
        .theme-cyan {
            --theme-color: #06b6d4;
            --theme-color-rgb: 6, 182, 212;
            --theme-gradient: linear-gradient(135deg, #06b6d4, #0891b2);
        }
        .theme-lime {
            --theme-color: #84cc16;
            --theme-color-rgb: 132, 204, 22;
            --theme-gradient: linear-gradient(135deg, #84cc16, #65a30d);
        }
        .theme-orange {
            --theme-color: #f97316;
            --theme-color-rgb: 249, 115, 22;
            --theme-gradient: linear-gradient(135deg, #f97316, #ea580c);
        }
        .theme-slate {
            --theme-color: #64748b;
            --theme-color-rgb: 100, 116, 139;
            --theme-gradient: linear-gradient(135deg, #64748b, #475569);
        }

        /* Dark Mode bg-theme overrides */
        body.theme-mode-dark .bg-theme-default { /* No override */ }
        body.theme-mode-dark .bg-theme-emerald { --card-bg: rgba(6, 78, 59, 0.45); --card-border: rgba(16, 185, 129, 0.2); }
        body.theme-mode-dark .bg-theme-indigo { --card-bg: rgba(49, 46, 129, 0.45); --card-border: rgba(99, 102, 241, 0.2); }
        body.theme-mode-dark .bg-theme-violet { --card-bg: rgba(76, 29, 149, 0.45); --card-border: rgba(139, 92, 246, 0.2); }
        body.theme-mode-dark .bg-theme-rose { --card-bg: rgba(136, 19, 55, 0.45); --card-border: rgba(244, 63, 94, 0.2); }
        body.theme-mode-dark .bg-theme-amber { --card-bg: rgba(120, 53, 4, 0.45); --card-border: rgba(245, 158, 11, 0.2); }
        body.theme-mode-dark .bg-theme-sky { --card-bg: rgba(12, 74, 96, 0.45); --card-border: rgba(14, 165, 233, 0.2); }
        body.theme-mode-dark .bg-theme-teal { --card-bg: rgba(19, 78, 74, 0.45); --card-border: rgba(20, 184, 166, 0.2); }
        body.theme-mode-dark .bg-theme-fuchsia { --card-bg: rgba(112, 26, 117, 0.45); --card-border: rgba(217, 70, 239, 0.2); }
        body.theme-mode-dark .bg-theme-cyan { --card-bg: rgba(22, 78, 99, 0.45); --card-border: rgba(6, 182, 212, 0.2); }
        body.theme-mode-dark .bg-theme-lime { --card-bg: rgba(63, 98, 18, 0.45); --card-border: rgba(132, 204, 22, 0.2); }
        body.theme-mode-dark .bg-theme-orange { --card-bg: rgba(124, 45, 18, 0.45); --card-border: rgba(249, 115, 22, 0.2); }
        body.theme-mode-dark .bg-theme-slate { --card-bg: rgba(30, 41, 59, 0.65); --card-border: rgba(100, 116, 139, 0.25); }

        /* Light Mode bg-theme overrides */
        body.theme-mode-light .bg-theme-default { /* No override */ }
        body.theme-mode-light .bg-theme-emerald { --card-bg: rgba(209, 250, 229, 0.65); --card-border: rgba(16, 185, 129, 0.3); }
        body.theme-mode-light .bg-theme-indigo { --card-bg: rgba(224, 231, 255, 0.65); --card-border: rgba(99, 102, 241, 0.3); }
        body.theme-mode-light .bg-theme-violet { --card-bg: rgba(237, 233, 254, 0.65); --card-border: rgba(139, 92, 246, 0.3); }
        body.theme-mode-light .bg-theme-rose { --card-bg: rgba(254, 226, 226, 0.65); --card-border: rgba(244, 63, 94, 0.3); }
        body.theme-mode-light .bg-theme-amber { --card-bg: rgba(254, 243, 199, 0.65); --card-border: rgba(245, 158, 11, 0.3); }
        body.theme-mode-light .bg-theme-sky { --card-bg: rgba(224, 242, 254, 0.65); --card-border: rgba(14, 165, 233, 0.3); }
        body.theme-mode-light .bg-theme-teal { --card-bg: rgba(204, 251, 241, 0.65); --card-border: rgba(20, 184, 166, 0.3); }
        body.theme-mode-light .bg-theme-fuchsia { --card-bg: rgba(250, 232, 255, 0.65); --card-border: rgba(217, 70, 239, 0.3); }
        body.theme-mode-light .bg-theme-cyan { --card-bg: rgba(207, 250, 254, 0.65); --card-border: rgba(6, 182, 212, 0.3); }
        body.theme-mode-light .bg-theme-lime { --card-bg: rgba(236, 253, 203, 0.65); --card-border: rgba(132, 204, 22, 0.3); }
        body.theme-mode-light .bg-theme-orange { --card-bg: rgba(255, 237, 213, 0.65); --card-border: rgba(249, 115, 22, 0.3); }
        body.theme-mode-light .bg-theme-slate { --card-bg: rgba(226, 232, 240, 0.85); --card-border: rgba(100, 116, 139, 0.3); }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(16, 185, 129, 0.04) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 2.5rem 3rem 8rem 3rem; /* Extra bottom padding for floating playback controls */
            overflow-x: hidden;
            transition: background-color 0.8s ease, color 0.8s ease;
        }

        /* Light Mode Specific Overrides */
        body.theme-mode-light {
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(16, 185, 129, 0.06) 0px, transparent 50%);
        }
        body.theme-mode-light .header-title-area h1 {
            background: linear-gradient(to right, #0f172a, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        body.theme-mode-light .group-title::after {
            background: rgba(15, 23, 42, 0.08);
        }
        body.theme-mode-light .card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }
        body.theme-mode-light .item-label {
            color: #334155;
        }
        body.theme-mode-light .item-values {
            color: #0f172a;
        }
        body.theme-mode-light .progress-bar-container {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        /* Light Mode Control Overrides */
        body.theme-mode-light .playback-controls {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(15, 23, 42, 0.1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }
        body.theme-mode-light .playback-timestamp {
            color: #0f172a;
        }
        body.theme-mode-light .play-btn {
            background: #0f172a;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }
        body.theme-mode-light .playback-info-area {
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }
        body.theme-mode-light .speed-control {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        body.theme-mode-light .speed-btn {
            color: #475569;
        }
        body.theme-mode-light .speed-btn.active {
            background: rgba(0, 0, 0, 0.1);
            color: #0f172a;
        }
        body.theme-mode-light .timeline-slider {
            background: rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 1.5rem;
        }

        .header-title-area h1 {
            font-size: 2.75rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            background: linear-gradient(to right, #ffffff, #9ca3af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
        }

        .header-title-area p {
            color: var(--text-gold);
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            margin-top: 0.25rem;
        }

        .live-btn {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #ef4444;
            padding: 0.6rem 1.2rem;
            border-radius: 99px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .live-btn:hover {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.4);
        }

        .live-btn .dot {
            width: 8px;
            height: 8px;
            background: currentColor;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.4; }
            100% { transform: scale(0.9); opacity: 1; }
        }

        /* Group Sections */
        .group-section {
            margin-bottom: 2.5rem;
        }

        .group-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .group-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.07);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        /* Glassmorphism Cards */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            transition: all 0.5s ease;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--theme-gradient);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            color: var(--theme-color);
            text-transform: uppercase;
        }

        /* Progress Item Styles */
        .progress-item {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .item-label-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .item-label {
            font-size: 1.15rem;
            font-weight: 700;
            color: #e2e8f0;
            letter-spacing: 0.01em;
        }

        .item-sublabel {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .item-values {
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            font-variant-numeric: tabular-nums;
        }

        .item-subvalues {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-right: 0.75rem;
        }

        /* Progress Bar Base */
        .progress-bar-container {
            width: 100%;
            height: 14px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 99px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 99px;
            width: 0%; /* Dynamic */
            background: var(--theme-gradient);
            transition: width 0.3s linear; /* Smooth linear animation for playback stepping */
            position: relative;
        }

        .progress-bar-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            animation: shimmer 2s infinite linear;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .item-status-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .item-pct {
            color: var(--theme-color);
            font-weight: 700;
        }

        .item-time {
            font-variant-numeric: tabular-nums;
        }

        /* FLOATING PLAYBACK BAR */
        .playback-controls {
            position: fixed;
            bottom: 1.5rem;
            left: 3rem;
            right: 3rem;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 1.25rem 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .play-btn {
            background: #ffffff;
            color: #0f172a;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
        }

        .play-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.4);
        }

        .playback-timeline-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .timeline-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 99px;
            background: rgba(255, 255, 255, 0.15);
            outline: none;
            cursor: pointer;
        }

        .timeline-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f59e0b;
            cursor: pointer;
            transition: transform 0.1s ease;
        }

        .timeline-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }

        .timeline-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }

        .playback-info-area {
            text-align: center;
            min-width: 160px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding-right: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .playback-timestamp {
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            font-variant-numeric: tabular-nums;
        }

        .playback-status {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-gold);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .speed-control {
            display: flex;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 3px;
            gap: 2px;
            flex-shrink: 0;
        }

        .speed-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.5rem 0.85rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .speed-btn.active {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .empty-banner {
            grid-column: span 3;
            background: rgba(255, 255, 255, 0.03);
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 5rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 1.25rem;
            font-weight: 600;
        }

        @media (max-width: 1200px) {
            .grid-layout {
                grid-template-columns: 1fr;
            }
            .playback-controls {
                flex-direction: column;
                border-radius: 20px;
                padding: 1rem;
                left: 1rem;
                right: 1rem;
                bottom: 1rem;
                gap: 1rem;
            }
            .playback-info-area {
                border-right: none;
                padding-right: 0;
                min-width: unset;
                width: 100%;
            }
            body {
                padding-bottom: 15rem;
            }
        }

        /* Theme Toggle Button Style */
        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            outline: none;
        }
        body.theme-mode-light .theme-toggle-btn {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #0f172a;
        }
        .theme-toggle-btn:hover {
            transform: scale(1.08);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.15);
        }
        body.theme-mode-light .theme-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.08);
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        
        /* Show correct icon based on mode */
        body.theme-mode-dark .theme-toggle-btn .light-icon { display: block; }
        body.theme-mode-dark .theme-toggle-btn .dark-icon { display: none; }
        body.theme-mode-light .theme-toggle-btn .light-icon { display: none; }
        body.theme-mode-light .theme-toggle-btn .dark-icon { display: block; }
    </style>
</head>
<body class="theme-mode-{{ $state->theme }}">

    <header>
        <div class="header-title-area">
            <h1>Progress Report Qurban Masjid Jogokariyan 1447H</h1>
            <p>TIME-LAPSE PLAYBACK PANEL</p>
        </div>
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <!-- Theme Toggle Button -->
            <button id="theme-toggle-btn" class="theme-toggle-btn" title="Ubah Tema Cerah/Gelap">
                <span class="dark-icon">🌙</span>
                <span class="light-icon">☀️</span>
            </button>
            <div>
                <a href="/progressreport" class="live-btn">
                    <span class="dot"></span>
                    LIVE MONITORING
                </a>
            </div>
        </div>
    </header>

    @if($logs->isEmpty())
        <div class="grid-layout">
            <div class="empty-banner">
                Belum ada data log yang terekam. Silakan update data di panel admin untuk melihat animasi playback.
            </div>
        </div>
    @else
        <!-- Group 1: PROSES QURBAN -->
        <section class="group-section">
            <h2 class="group-title">Proses Qurban</h2>
            <div class="grid-layout">
                
                <!-- Block 1: PENYEMBELIHAN -->
                <div id="card_block_1" class="card theme-{{ $state->color_block_1 }} bg-theme-{{ $state->bg_block_1 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Penyembelihan</h3>
                    </div>
                    
                    <!-- Sapi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI</span>
                            <span id="penyembelihan_sapi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="penyembelihan_sapi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penyembelihan_sapi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="penyembelihan_sapi_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Kambing -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">KAMBING</span>
                            <span id="penyembelihan_kambing_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="penyembelihan_kambing_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penyembelihan_kambing_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="penyembelihan_kambing_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 2: PENGELETAN -->
                <div id="card_block_2" class="card theme-{{ $state->color_block_2 }} bg-theme-{{ $state->bg_block_2 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Pengeletan</h3>
                    </div>
                    
                    <!-- Sapi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI</span>
                            <span id="pengeletan_sapi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="pengeletan_sapi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="pengeletan_sapi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="pengeletan_sapi_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Kambing -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">KAMBING</span>
                            <span id="pengeletan_kambing_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="pengeletan_kambing_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="pengeletan_kambing_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="pengeletan_kambing_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 3: PENIMBANGAN -->
                <div id="card_block_3" class="card theme-{{ $state->color_block_3 }} bg-theme-{{ $state->bg_block_3 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Penimbangan</h3>
                    </div>
                    
                    <!-- Sapi Reguler -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI REGULER</span>
                            <span id="penimbangan_sapi_reguler_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="penimbangan_sapi_reguler_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penimbangan_sapi_reguler_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="penimbangan_sapi_reguler_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Sapi Khusus -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <div>
                                <span class="item-label">SAPI KHUSUS</span>
                                <div class="item-sublabel">Super, Duper & Pribadi</div>
                            </div>
                            <span id="penimbangan_sapi_khusus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="penimbangan_sapi_khusus_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penimbangan_sapi_khusus_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="penimbangan_sapi_khusus_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Kambing -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">KAMBING</span>
                            <span id="penimbangan_kambing_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="penimbangan_kambing_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penimbangan_kambing_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="penimbangan_kambing_time">-</span>)</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Group 2: DISTRIBUSI QURBAN -->
        <section class="group-section">
            <h2 class="group-title">Distribusian Qurban</h2>
            <div class="grid-layout">
                
                <!-- Block 4: SOHIBUL QURBAN SAPI -->
                <div id="card_block_4" class="card theme-{{ $state->color_block_4 }} bg-theme-{{ $state->bg_block_4 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Sohibul Qurban Sapi</h3>
                    </div>
                    
                    <!-- Sapi Reguler Terbungkus -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI REGULER - TERBUNGKUS</span>
                            <div>
                                <span class="item-subvalues">Tidak Diambil: <span id="sohibul_sapi_reguler_tidak_diambil_val">0</span></span>
                                <span id="sohibul_sapi_reguler_terbungkus_val" class="item-values">-/-</span>
                            </div>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_sapi_reguler_terbungkus_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_reguler_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_sapi_reguler_terbungkus_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Sapi Reguler Terdistribusi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI REGULER - TERDISTRIBUSI</span>
                            <span id="sohibul_sapi_reguler_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_sapi_reguler_terdistribusi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_reguler_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_sapi_reguler_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Sapi Khusus Terbungkus -->
                    <div class="progress-item" style="border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 1.25rem;">
                        <div class="item-label-row">
                            <div>
                                <span class="item-label">SAPI KHUSUS - TERBUNGKUS</span>
                                <div class="item-sublabel">Super, Duper & Pribadi</div>
                            </div>
                            <div>
                                <span class="item-subvalues">Tidak Diambil: <span id="sohibul_sapi_khusus_tidak_diambil_val">0</span></span>
                                <span id="sohibul_sapi_khusus_terbungkus_val" class="item-values">-/-</span>
                            </div>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_sapi_khusus_terbungkus_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_khusus_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_sapi_khusus_terbungkus_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Sapi Khusus Terdistribusi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <div>
                                <span class="item-label">SAPI KHUSUS - TERDISTRIBUSI</span>
                                <div class="item-sublabel">Super, Duper & Pribadi</div>
                            </div>
                            <span id="sohibul_sapi_khusus_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_sapi_khusus_terdistribusi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_khusus_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_sapi_khusus_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 5: SOHIBUL QURBAN KAMBING -->
                <div id="card_block_5" class="card theme-{{ $state->color_block_5 }} bg-theme-{{ $state->bg_block_5 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Sohibul Qurban Kambing</h3>
                    </div>
                    
                    <!-- Terbungkus -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <span id="sohibul_kambing_terbungkus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_kambing_terbungkus_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_kambing_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_kambing_terbungkus_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Terdistribusi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="sohibul_kambing_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="sohibul_kambing_terdistribusi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_kambing_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="sohibul_kambing_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 6: DISTRIBUSI BUNGKUSAN DAGING -->
                <div id="card_block_6" class="card theme-{{ $state->color_block_6 }} bg-theme-{{ $state->bg_block_6 ?? 'default' }}">
                    <div class="card-header">
                        <h3 class="card-title">Distribusi Bungkus Daging</h3>
                    </div>
                    
                    <!-- Terbungkus -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <span id="bungkusan_daging_terbungkus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="bungkusan_daging_terbungkus_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="bungkusan_daging_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="bungkusan_daging_terbungkus_time">-</span>)</span>
                        </div>
                    </div>

                    <!-- Terdistribusi -->
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="bungkusan_daging_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container">
                            <div id="bungkusan_daging_terdistribusi_bar" class="progress-bar-fill"></div>
                        </div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="bungkusan_daging_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span class="item-time">(<span id="bungkusan_daging_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- FLOATING CONTROLS -->
        <div class="playback-controls">
            <button id="btn-play" class="play-btn">▶</button>
            
            <div class="playback-info-area">
                <div id="playback-time" class="playback-timestamp">00:00</div>
                <div id="playback-status" class="playback-status">PAUSED</div>
            </div>

            <div class="playback-timeline-area">
                <input type="range" id="timeline-slider" class="timeline-slider" min="0" max="0" value="0">
                <div class="timeline-labels">
                    <span id="time-start">00:00</span>
                    <span id="time-end">23:59</span>
                </div>
            </div>

            <div class="speed-control">
                <button class="speed-btn active" data-speed="1">1m/s</button>
                <button class="speed-btn" data-speed="5">5m/s</button>
                <button class="speed-btn" data-speed="10">10m/s</button>
                <button class="speed-btn" data-speed="30">30m/s</button>
            </div>
        </div>

        <script id="logs-data" type="application/json">
            @json($logs)
        </script>

        <script>
            // Parse raw logs
            const logs = JSON.parse(document.getElementById('logs-data').textContent);

            if (logs.length > 0) {
                // Reconstruct minute-by-minute timeline
                const startMs = new Date(logs[0].created_at).getTime();
                const endMs = new Date(logs[logs.length - 1].created_at).getTime();
                
                // Get starting and ending minute timestamps
                const startMin = Math.floor(startMs / 60000);
                const endMin = Math.ceil(endMs / 60000);
                
                const timeline = [];
                for (let m = startMin; m <= endMin; m++) {
                    const timeMs = m * 60000;
                    const dateObj = new Date(timeMs);
                    
                    // Find latest log before or at this minute
                    let activeLog = logs[0];
                    for (let i = 0; i < logs.length; i++) {
                        const logMs = new Date(logs[i].created_at).getTime();
                        if (logMs <= timeMs) {
                            activeLog = logs[i];
                        } else {
                            break;
                        }
                    }
                    
                    timeline.push({
                        time: dateObj,
                        state: activeLog.state,
                        formatted_clock: dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                        formatted_date: dateObj.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' })
                    });
                }

                // Initial setup
                let currentIdx = 0;
                let isPlaying = false;
                let playbackSpeed = 1; // minutes per second
                let timer = null;

                const btnPlay = document.getElementById('btn-play');
                const slider = document.getElementById('timeline-slider');
                const lblTime = document.getElementById('playback-time');
                const lblStatus = document.getElementById('playback-status');
                const lblStart = document.getElementById('time-start');
                const lblEnd = document.getElementById('time-end');
                const speedBtns = document.querySelectorAll('.speed-btn');

                slider.max = timeline.length - 1;
                lblStart.textContent = timeline[0].formatted_clock;
                lblEnd.textContent = timeline[timeline.length - 1].formatted_clock;

                // Update UI state
                function renderState(idx) {
                    const entry = timeline[idx];
                    const data = entry.state;

                    // Update clock
                    lblTime.textContent = entry.formatted_clock;

                    // Update slider
                    slider.value = idx;

                    // Update theme mode (light/dark) dynamically ONLY if no local preference override exists
                    if (!localStorage.getItem('progress-theme-override')) {
                        const body = document.body;
                        const newThemeMode = `theme-mode-${data.theme || 'dark'}`;
                        if (!body.classList.contains(newThemeMode)) {
                            body.classList.remove('theme-mode-dark', 'theme-mode-light');
                            body.classList.add(newThemeMode);
                        }
                    }

                    // Update card theme colors dynamically
                    for (let i = 1; i <= 6; i++) {
                        const card = document.getElementById(`card_block_${i}`);
                        const newTheme = `theme-${data[`color_block_${i}`] || 'emerald'}`;
                        const newBg = `bg-theme-${data[`bg_block_${i}`] || 'default'}`;
                        if (card) {
                            card.className = card.className.split(' ').filter(c => !c.startsWith('theme-') && !c.startsWith('bg-theme-')).join(' ');
                            card.classList.add(newTheme, newBg);
                        }
                    }

                    // Helper calculations
                    function calcPercent(num, den) {
                        if (!den || den === 0) return 0;
                        return Math.min(Math.round((num / den) * 100), 100);
                    }

                    function updateElementValue(id, value) {
                        const el = document.getElementById(id);
                        if (el) el.textContent = value;
                    }

                    function updateProgressBar(id, pct) {
                        const el = document.getElementById(id);
                        if (el) el.style.width = pct + '%';
                    }

                    // Block 1: Penyembelihan
                    const sapiSembePct = calcPercent(data.penyembelihan_sapi_tersembelih, data.penyembelihan_sapi_total);
                    updateElementValue('penyembelihan_sapi_val', `${data.penyembelihan_sapi_tersembelih}/${data.penyembelihan_sapi_total}`);
                    updateElementValue('penyembelihan_sapi_pct', sapiSembePct);
                    updateProgressBar('penyembelihan_sapi_bar', sapiSembePct);
                    updateElementValue('penyembelihan_sapi_time', data.penyembelihan_sapi_time_formatted || '-');

                    const kambSembePct = calcPercent(data.penyembelihan_kambing_tersembelih, data.penyembelihan_kambing_total);
                    updateElementValue('penyembelihan_kambing_val', `${data.penyembelihan_kambing_tersembelih}/${data.penyembelihan_kambing_total}`);
                    updateElementValue('penyembelihan_kambing_pct', kambSembePct);
                    updateProgressBar('penyembelihan_kambing_bar', kambSembePct);
                    updateElementValue('penyembelihan_kambing_time', data.penyembelihan_kambing_time_formatted || '-');

                    // Block 2: Pengeletan
                    const sapiKeletPct = calcPercent(data.pengeletan_sapi_terkelet, data.pengeletan_sapi_total);
                    updateElementValue('pengeletan_sapi_val', `${data.pengeletan_sapi_terkelet}/${data.pengeletan_sapi_total}`);
                    updateElementValue('pengeletan_sapi_pct', sapiKeletPct);
                    updateProgressBar('pengeletan_sapi_bar', sapiKeletPct);
                    updateElementValue('pengeletan_sapi_time', data.pengeletan_sapi_time_formatted || '-');

                    const kambKeletPct = calcPercent(data.pengeletan_kambing_terkelet, data.pengeletan_kambing_total);
                    updateElementValue('pengeletan_kambing_val', `${data.pengeletan_kambing_terkelet}/${data.pengeletan_kambing_total}`);
                    updateElementValue('pengeletan_kambing_pct', kambKeletPct);
                    updateProgressBar('pengeletan_kambing_bar', kambKeletPct);
                    updateElementValue('pengeletan_kambing_time', data.pengeletan_kambing_time_formatted || '-');

                    // Block 3: Penimbangan
                    const sapiRegTimbangPct = calcPercent(data.penimbangan_sapi_reguler_tertimbang, data.penimbangan_sapi_reguler_total);
                    updateElementValue('penimbangan_sapi_reguler_val', `${data.penimbangan_sapi_reguler_tertimbang}/${data.penimbangan_sapi_reguler_total}`);
                    updateElementValue('penimbangan_sapi_reguler_pct', sapiRegTimbangPct);
                    updateProgressBar('penimbangan_sapi_reguler_bar', sapiRegTimbangPct);
                    updateElementValue('penimbangan_sapi_reguler_time', data.penimbangan_sapi_reguler_time_formatted || '-');

                    const sapiKhusTimbangPct = calcPercent(data.penimbangan_sapi_khusus_tertimbang, data.penimbangan_sapi_khusus_total);
                    updateElementValue('penimbangan_sapi_khusus_val', `${data.penimbangan_sapi_khusus_tertimbang}/${data.penimbangan_sapi_khusus_total}`);
                    updateElementValue('penimbangan_sapi_khusus_pct', sapiKhusTimbangPct);
                    updateProgressBar('penimbangan_sapi_khusus_bar', sapiKhusTimbangPct);
                    updateElementValue('penimbangan_sapi_khusus_time', data.penimbangan_sapi_khusus_time_formatted || '-');

                    const kambTimbangPct = calcPercent(data.penimbangan_kambing_tertimbang, data.penimbangan_kambing_total);
                    updateElementValue('penimbangan_kambing_val', `${data.penimbangan_kambing_tertimbang}/${data.penimbangan_kambing_total}`);
                    updateElementValue('penimbangan_kambing_pct', kambTimbangPct);
                    updateProgressBar('penimbangan_kambing_bar', kambTimbangPct);
                    updateElementValue('penimbangan_kambing_time', data.penimbangan_kambing_time_formatted || '-');

                    // Block 4: Sohibul Qurban Sapi
                    // Reguler Terbungkus
                    const sohibulRegBungkusPct = calcPercent(data.sohibul_sapi_reguler_terbungkus, data.sohibul_sapi_reguler_total);
                    updateElementValue('sohibul_sapi_reguler_tidak_diambil_val', data.sohibul_sapi_reguler_tidak_diambil);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_val', `${data.sohibul_sapi_reguler_terbungkus}/${data.sohibul_sapi_reguler_total}`);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_pct', sohibulRegBungkusPct);
                    updateProgressBar('sohibul_sapi_reguler_terbungkus_bar', sohibulRegBungkusPct);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_time', data.sohibul_sapi_reguler_terbungkus_time_formatted || '-');

                    // Reguler Terdistribusi (total - tidak diambil)
                    const denomRegDist = data.sohibul_sapi_reguler_total - data.sohibul_sapi_reguler_tidak_diambil;
                    const sohibulRegDistPct = calcPercent(data.sohibul_sapi_reguler_terdistribusi, denomRegDist);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_val', `${data.sohibul_sapi_reguler_terdistribusi}/${denomRegDist}`);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_pct', sohibulRegDistPct);
                    updateProgressBar('sohibul_sapi_reguler_terdistribusi_bar', sohibulRegDistPct);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_time', data.sohibul_sapi_reguler_terdistribusi_time_formatted || '-');

                    // Khusus Terbungkus
                    const sohibulKhusBungkusPct = calcPercent(data.sohibul_sapi_khusus_terbungkus, data.sohibul_sapi_khusus_total);
                    updateElementValue('sohibul_sapi_khusus_tidak_diambil_val', data.sohibul_sapi_khusus_tidak_diambil);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_val', `${data.sohibul_sapi_khusus_terbungkus}/${data.sohibul_sapi_khusus_total}`);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_pct', sohibulKhusBungkusPct);
                    updateProgressBar('sohibul_sapi_khusus_terbungkus_bar', sohibulKhusBungkusPct);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_time', data.sohibul_sapi_khusus_terbungkus_time_formatted || '-');

                    // Khusus Terdistribusi (total - tidak diambil)
                    const denomKhusDist = data.sohibul_sapi_khusus_total - data.sohibul_sapi_khusus_tidak_diambil;
                    const sohibulKhusDistPct = calcPercent(data.sohibul_sapi_khusus_terdistribusi, denomKhusDist);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_val', `${data.sohibul_sapi_khusus_terdistribusi}/${denomKhusDist}`);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_pct', sohibulKhusDistPct);
                    updateProgressBar('sohibul_sapi_khusus_terdistribusi_bar', sohibulKhusDistPct);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_time', data.sohibul_sapi_khusus_terdistribusi_time_formatted || '-');

                    // Block 5: Sohibul Qurban Kambing
                    const sohibulKambBungkusPct = calcPercent(data.sohibul_kambing_terbungkus, data.sohibul_kambing_total);
                    updateElementValue('sohibul_kambing_terbungkus_val', `${data.sohibul_kambing_terbungkus}/${data.sohibul_kambing_total}`);
                    updateElementValue('sohibul_kambing_terbungkus_pct', sohibulKambBungkusPct);
                    updateProgressBar('sohibul_kambing_terbungkus_bar', sohibulKambBungkusPct);
                    updateElementValue('sohibul_kambing_terbungkus_time', data.sohibul_kambing_terbungkus_time_formatted || '-');

                    const sohibulKambDistPct = calcPercent(data.sohibul_kambing_terdistribusi, data.sohibul_kambing_total);
                    updateElementValue('sohibul_kambing_terdistribusi_val', `${data.sohibul_kambing_terdistribusi}/${data.sohibul_kambing_total}`);
                    updateElementValue('sohibul_kambing_terdistribusi_pct', sohibulKambDistPct);
                    updateProgressBar('sohibul_kambing_terdistribusi_bar', sohibulKambDistPct);
                    updateElementValue('sohibul_kambing_terdistribusi_time', data.sohibul_kambing_terdistribusi_time_formatted || '-');

                    // Block 6: Distribusi Bungkus Daging
                    const bungkusanBungkusPct = calcPercent(data.bungkusan_daging_terbungkus, data.bungkusan_daging_total);
                    updateElementValue('bungkusan_daging_terbungkus_val', `${data.bungkusan_daging_terbungkus}/${data.bungkusan_daging_total}`);
                    updateElementValue('bungkusan_daging_terbungkus_pct', bungkusanBungkusPct);
                    updateProgressBar('bungkusan_daging_terbungkus_bar', bungkusanBungkusPct);
                    updateElementValue('bungkusan_daging_terbungkus_time', data.bungkusan_daging_terbungkus_time_formatted || '-');

                    const bungkusanDistPct = calcPercent(data.bungkusan_daging_terdistribusi, data.bungkusan_daging_total);
                    updateElementValue('bungkusan_daging_terdistribusi_val', `${data.bungkusan_daging_terdistribusi}/${data.bungkusan_daging_total}`);
                    updateElementValue('bungkusan_daging_terdistribusi_pct', bungkusanDistPct);
                    updateProgressBar('bungkusan_daging_terdistribusi_bar', bungkusanDistPct);
                    updateElementValue('bungkusan_daging_terdistribusi_time', data.bungkusan_daging_terdistribusi_time_formatted || '-');
                }

                // Tick of playback timer
                function playbackStep() {
                    if (currentIdx >= timeline.length - 1) {
                        // Pause at the end
                        pausePlayback();
                        return;
                    }
                    currentIdx++;
                    renderState(currentIdx);
                }

                function playPlayback() {
                    isPlaying = true;
                    btnPlay.textContent = '❚❚';
                    lblStatus.textContent = 'PLAYING';
                    
                    // Interval based on speed: e.g. speed 1 means 1000ms delay per step (1 minute = 1 second)
                    // speed 10 means 100ms delay per step (10 minutes = 1 second)
                    const intervalMs = Math.round(1000 / playbackSpeed);
                    timer = setInterval(playbackStep, intervalMs);
                }

                function pausePlayback() {
                    isPlaying = false;
                    btnPlay.textContent = '▶';
                    lblStatus.textContent = 'PAUSED';
                    if (timer) {
                        clearInterval(timer);
                        timer = null;
                    }
                }

                // Handle Play/Pause click
                btnPlay.addEventListener('click', () => {
                    if (isPlaying) {
                        pausePlayback();
                    } else {
                        // If at the end, restart from beginning
                        if (currentIdx >= timeline.length - 1) {
                            currentIdx = 0;
                        }
                        playPlayback();
                    }
                });

                // Handle slider input (dragging)
                slider.addEventListener('input', (e) => {
                    pausePlayback();
                    currentIdx = parseInt(e.target.value);
                    renderState(currentIdx);
                });

                // Handle speed buttons click
                speedBtns.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        speedBtns.forEach(b => b.classList.remove('active'));
                        e.target.classList.add('active');
                        playbackSpeed = parseInt(e.target.getAttribute('data-speed'));
                        
                        if (isPlaying) {
                            // Restart timer with new speed
                            pausePlayback();
                            playPlayback();
                        }
                    });
                });

                 // Initial render
                 renderState(currentIdx);
             }

             // Theme Local Toggle Script
             const themeToggleBtn = document.getElementById('theme-toggle-btn');
             if (themeToggleBtn) {
                 // Apply localStorage override if exists
                 const localTheme = localStorage.getItem('progress-theme-override');
                 if (localTheme) {
                     document.body.classList.remove('theme-mode-dark', 'theme-mode-light');
                     document.body.classList.add(`theme-mode-${localTheme}`);
                 }

                 themeToggleBtn.addEventListener('click', () => {
                     const isDark = document.body.classList.contains('theme-mode-dark');
                     const nextTheme = isDark ? 'light' : 'dark';
                     
                     document.body.classList.remove('theme-mode-dark', 'theme-mode-light');
                     document.body.classList.add(`theme-mode-${nextTheme}`);
                     
                     // Save preference
                     localStorage.setItem('progress-theme-override', nextTheme);
                 });
             }
         </script>
    @endif
</body>
</html>
