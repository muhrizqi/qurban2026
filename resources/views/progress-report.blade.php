<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress Report Qurban Masjid Jogokariyan 1447H</title>
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
            padding: 2.5rem 3rem;
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
        body.theme-mode-light #clock-time {
            color: #0f172a;
        }
        body.theme-mode-light .group-title::after {
            background: rgba(15, 23, 42, 0.08);
        }
        body.theme-mode-light .card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }
        body.theme-mode-light .card:hover {
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.05), 
                0 0 20px 0 rgba(var(--theme-color-rgb), 0.12);
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

        /* Header styling suited for big TV screen */
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

        .header-clock {
            text-align: right;
        }

        #clock-time {
            font-size: 2.5rem;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
            color: #ffffff;
        }

        #clock-date {
            font-size: 1.1rem;
            color: var(--text-muted);
            font-weight: 500;
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

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(var(--theme-color-rgb), 0.3);
            box-shadow: 
                0 12px 40px 0 rgba(0, 0, 0, 0.4),
                0 0 20px 0 rgba(var(--theme-color-rgb), 0.15);
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
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
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
                rgba(255, 255, 255, 0) 100*
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

        .footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-muted);
            font-size: 1rem;
            font-weight: 500;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
        }

        .footer-logo {
            font-weight: 700;
            color: var(--text-gold);
        }

        /* Mobile responsiveness / smaller displays override (if needed) */
        @media (max-width: 1200px) {
            .grid-layout {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            body {
                padding: 1.5rem;
            }
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .header-clock {
                text-align: left;
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
            <p>LIVE MONITORING DASHBOARD</p>
        </div>
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <!-- Theme Toggle Button -->
            <button id="theme-toggle-btn" class="theme-toggle-btn" title="Ubah Tema Cerah/Gelap">
                <span class="dark-icon">🌙</span>
                <span class="light-icon">☀️</span>
            </button>
            <div class="header-clock">
                <div id="clock-time">00:00:00</div>
                <div id="clock-date">Memuat tanggal...</div>
            </div>
        </div>
    </header>

    <!-- Group 1: PROSES QURBAN -->
    <section class="group-section">
        <h2 class="group-title">Proses Qurban</h2>
        <div class="grid-layout">
            
            <!-- Block 1: PENYEMBELIHAN -->
            <div id="card_block_1" class="card theme-{{ $state->color_block_1 }}">
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
            <div id="card_block_2" class="card theme-{{ $state->color_block_2 }}">
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
            <div id="card_block_3" class="card theme-{{ $state->color_block_3 }}">
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
            <div id="card_block_4" class="card theme-{{ $state->color_block_4 }}">
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
            <div id="card_block_5" class="card theme-{{ $state->color_block_5 }}">
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
            <div id="card_block_6" class="card theme-{{ $state->color_block_6 }}">
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

    <footer class="footer">
        <div>&copy; 1447H / {{ date('Y') }} Masjid Jogokariyan Yogyakarta. Seluruh data terupdate secara real-time.</div>
        <div class="footer-logo">JOGOKARIYAN QURBAN MONITORING</div>
    </footer>

    <script>
        // System Clock Script
        function updateClock() {
            const now = new Date();
            
            // Format time
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock-time').textContent = `${hours}:${minutes}:${seconds}`;

            // Format date (Indonesian style)
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('clock-date').textContent = now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Safe percentage calculator
        function calcPercent(num, den) {
            if (!den || den === 0) return 0;
            const pct = (num / den) * 100;
            return Math.min(Math.round(pct), 100);
        }

        // DOM elements update helper
        function updateElementValue(id, value) {
            const el = document.getElementById(id);
            if (el && el.textContent !== String(value)) {
                el.textContent = value;
            }
        }

        // DOM progress bar width update helper
        function updateProgressBar(id, pct) {
            const el = document.getElementById(id);
            if (el) {
                el.style.width = pct + '%';
            }
        }

        // Live Polling Logic
        let lastUpdated = '';

        function pollData() {
            fetch('/progressreport/data')
                .then(response => response.json())
                .then(data => {
                    // Update theme mode (light/dark) dynamically ONLY if no local preference override exists
                    if (!localStorage.getItem('progress-theme-override')) {
                        const body = document.body;
                        const newThemeMode = `theme-mode-${data.theme}`;
                        if (!body.classList.contains(newThemeMode)) {
                            body.classList.remove('theme-mode-dark', 'theme-mode-light');
                            body.classList.add(newThemeMode);
                        }
                    }

                    // Update theme colors dynamically on cards
                    for (let i = 1; i <= 6; i++) {
                        const card = document.getElementById(`card_block_${i}`);
                        const newTheme = `theme-${data[`color_block_${i}`]}`;
                        if (card && !card.classList.contains(newTheme)) {
                            // Strip old theme classes and add new one
                            card.className = card.className.split(' ').filter(c => !c.startsWith('theme-')).join(' ');
                            card.classList.add(newTheme);
                        }
                    }

                    // Block 1: Penyembelihan
                    const sapiSembePct = calcPercent(data.penyembelihan_sapi_tersembelih, data.penyembelihan_sapi_total);
                    updateElementValue('penyembelihan_sapi_val', `${data.penyembelihan_sapi_tersembelih}/${data.penyembelihan_sapi_total}`);
                    updateElementValue('penyembelihan_sapi_pct', sapiSembePct);
                    updateProgressBar('penyembelihan_sapi_bar', sapiSembePct);
                    updateElementValue('penyembelihan_sapi_time', data.penyembelihan_sapi_time_formatted);

                    const kambSembePct = calcPercent(data.penyembelihan_kambing_tersembelih, data.penyembelihan_kambing_total);
                    updateElementValue('penyembelihan_kambing_val', `${data.penyembelihan_kambing_tersembelih}/${data.penyembelihan_kambing_total}`);
                    updateElementValue('penyembelihan_kambing_pct', kambSembePct);
                    updateProgressBar('penyembelihan_kambing_bar', kambSembePct);
                    updateElementValue('penyembelihan_kambing_time', data.penyembelihan_kambing_time_formatted);

                    // Block 2: Pengeletan
                    const sapiKeletPct = calcPercent(data.pengeletan_sapi_terkelet, data.pengeletan_sapi_total);
                    updateElementValue('pengeletan_sapi_val', `${data.pengeletan_sapi_terkelet}/${data.pengeletan_sapi_total}`);
                    updateElementValue('pengeletan_sapi_pct', sapiKeletPct);
                    updateProgressBar('pengeletan_sapi_bar', sapiKeletPct);
                    updateElementValue('pengeletan_sapi_time', data.pengeletan_sapi_time_formatted);

                    const kambKeletPct = calcPercent(data.pengeletan_kambing_terkelet, data.pengeletan_kambing_total);
                    updateElementValue('pengeletan_kambing_val', `${data.pengeletan_kambing_terkelet}/${data.pengeletan_kambing_total}`);
                    updateElementValue('pengeletan_kambing_pct', kambKeletPct);
                    updateProgressBar('pengeletan_kambing_bar', kambKeletPct);
                    updateElementValue('pengeletan_kambing_time', data.pengeletan_kambing_time_formatted);

                    // Block 3: Penimbangan
                    const sapiRegTimbangPct = calcPercent(data.penimbangan_sapi_reguler_tertimbang, data.penimbangan_sapi_reguler_total);
                    updateElementValue('penimbangan_sapi_reguler_val', `${data.penimbangan_sapi_reguler_tertimbang}/${data.penimbangan_sapi_reguler_total}`);
                    updateElementValue('penimbangan_sapi_reguler_pct', sapiRegTimbangPct);
                    updateProgressBar('penimbangan_sapi_reguler_bar', sapiRegTimbangPct);
                    updateElementValue('penimbangan_sapi_reguler_time', data.penimbangan_sapi_reguler_time_formatted);

                    const sapiKhusTimbangPct = calcPercent(data.penimbangan_sapi_khusus_tertimbang, data.penimbangan_sapi_khusus_total);
                    updateElementValue('penimbangan_sapi_khusus_val', `${data.penimbangan_sapi_khusus_tertimbang}/${data.penimbangan_sapi_khusus_total}`);
                    updateElementValue('penimbangan_sapi_khusus_pct', sapiKhusTimbangPct);
                    updateProgressBar('penimbangan_sapi_khusus_bar', sapiKhusTimbangPct);
                    updateElementValue('penimbangan_sapi_khusus_time', data.penimbangan_sapi_khusus_time_formatted);

                    const kambTimbangPct = calcPercent(data.penimbangan_kambing_tertimbang, data.penimbangan_kambing_total);
                    updateElementValue('penimbangan_kambing_val', `${data.penimbangan_kambing_tertimbang}/${data.penimbangan_kambing_total}`);
                    updateElementValue('penimbangan_kambing_pct', kambTimbangPct);
                    updateProgressBar('penimbangan_kambing_bar', kambTimbangPct);
                    updateElementValue('penimbangan_kambing_time', data.penimbangan_kambing_time_formatted);

                    // Block 4: Sohibul Qurban Sapi
                    // Reguler Terbungkus
                    const sohibulRegBungkusPct = calcPercent(data.sohibul_sapi_reguler_terbungkus, data.sohibul_sapi_reguler_total);
                    updateElementValue('sohibul_sapi_reguler_tidak_diambil_val', data.sohibul_sapi_reguler_tidak_diambil);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_val', `${data.sohibul_sapi_reguler_terbungkus}/${data.sohibul_sapi_reguler_total}`);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_pct', sohibulRegBungkusPct);
                    updateProgressBar('sohibul_sapi_reguler_terbungkus_bar', sohibulRegBungkusPct);
                    updateElementValue('sohibul_sapi_reguler_terbungkus_time', data.sohibul_sapi_reguler_terbungkus_time_formatted);

                    // Reguler Terdistribusi (total - tidak diambil)
                    const denomRegDist = data.sohibul_sapi_reguler_total - data.sohibul_sapi_reguler_tidak_diambil;
                    const sohibulRegDistPct = calcPercent(data.sohibul_sapi_reguler_terdistribusi, denomRegDist);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_val', `${data.sohibul_sapi_reguler_terdistribusi}/${denomRegDist}`);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_pct', sohibulRegDistPct);
                    updateProgressBar('sohibul_sapi_reguler_terdistribusi_bar', sohibulRegDistPct);
                    updateElementValue('sohibul_sapi_reguler_terdistribusi_time', data.sohibul_sapi_reguler_terdistribusi_time_formatted);

                    // Khusus Terbungkus
                    const sohibulKhusBungkusPct = calcPercent(data.sohibul_sapi_khusus_terbungkus, data.sohibul_sapi_khusus_total);
                    updateElementValue('sohibul_sapi_khusus_tidak_diambil_val', data.sohibul_sapi_khusus_tidak_diambil);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_val', `${data.sohibul_sapi_khusus_terbungkus}/${data.sohibul_sapi_khusus_total}`);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_pct', sohibulKhusBungkusPct);
                    updateProgressBar('sohibul_sapi_khusus_terbungkus_bar', sohibulKhusBungkusPct);
                    updateElementValue('sohibul_sapi_khusus_terbungkus_time', data.sohibul_sapi_khusus_terbungkus_time_formatted);

                    // Khusus Terdistribusi (total - tidak diambil)
                    const denomKhusDist = data.sohibul_sapi_khusus_total - data.sohibul_sapi_khusus_tidak_diambil;
                    const sohibulKhusDistPct = calcPercent(data.sohibul_sapi_khusus_terdistribusi, denomKhusDist);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_val', `${data.sohibul_sapi_khusus_terdistribusi}/${denomKhusDist}`);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_pct', sohibulKhusDistPct);
                    updateProgressBar('sohibul_sapi_khusus_terdistribusi_bar', sohibulKhusDistPct);
                    updateElementValue('sohibul_sapi_khusus_terdistribusi_time', data.sohibul_sapi_khusus_terdistribusi_time_formatted);

                    // Block 5: Sohibul Qurban Kambing
                    const sohibulKambBungkusPct = calcPercent(data.sohibul_kambing_terbungkus, data.sohibul_kambing_total);
                    updateElementValue('sohibul_kambing_terbungkus_val', `${data.sohibul_kambing_terbungkus}/${data.sohibul_kambing_total}`);
                    updateElementValue('sohibul_kambing_terbungkus_pct', sohibulKambBungkusPct);
                    updateProgressBar('sohibul_kambing_terbungkus_bar', sohibulKambBungkusPct);
                    updateElementValue('sohibul_kambing_terbungkus_time', data.sohibul_kambing_terbungkus_time_formatted);

                    const sohibulKambDistPct = calcPercent(data.sohibul_kambing_terdistribusi, data.sohibul_kambing_total);
                    updateElementValue('sohibul_kambing_terdistribusi_val', `${data.sohibul_kambing_terdistribusi}/${data.sohibul_kambing_total}`);
                    updateElementValue('sohibul_kambing_terdistribusi_pct', sohibulKambDistPct);
                    updateProgressBar('sohibul_kambing_terdistribusi_bar', sohibulKambDistPct);
                    updateElementValue('sohibul_kambing_terdistribusi_time', data.sohibul_kambing_terdistribusi_time_formatted);

                    // Block 6: Distribusi Bungkus Daging
                    const bungkusanBungkusPct = calcPercent(data.bungkusan_daging_terbungkus, data.bungkusan_daging_total);
                    updateElementValue('bungkusan_daging_terbungkus_val', `${data.bungkusan_daging_terbungkus}/${data.bungkusan_daging_total}`);
                    updateElementValue('bungkusan_daging_terbungkus_pct', bungkusanBungkusPct);
                    updateProgressBar('bungkusan_daging_terbungkus_bar', bungkusanBungkusPct);
                    updateElementValue('bungkusan_daging_terbungkus_time', data.bungkusan_daging_terbungkus_time_formatted);

                    const bungkusanDistPct = calcPercent(data.bungkusan_daging_terdistribusi, data.bungkusan_daging_total);
                    updateElementValue('bungkusan_daging_terdistribusi_val', `${data.bungkusan_daging_terdistribusi}/${data.bungkusan_daging_total}`);
                    updateElementValue('bungkusan_daging_terdistribusi_pct', bungkusanDistPct);
                    updateProgressBar('bungkusan_daging_terdistribusi_bar', bungkusanDistPct);
                    updateElementValue('bungkusan_daging_terdistribusi_time', data.bungkusan_daging_terdistribusi_time_formatted);
                })
                .catch(err => console.error('Gagal mengambil data progress report:', err));
        }

        // Poll immediately and then every 2 seconds
        pollData();
        setInterval(pollData, 2000);

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
</body>
</html>
