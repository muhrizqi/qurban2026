<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Playback History - Progress Report Qurban 1447H</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* ─── Theme Variables ─── */
        body.theme-mode-dark {
            --bg-color: #060b14;
            --bg-gradient-1: rgba(99, 102, 241, 0.06);
            --bg-gradient-2: rgba(16, 185, 129, 0.05);
            --card-bg: rgba(15, 23, 42, 0.78);
            --card-border: rgba(255, 255, 255, 0.07);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --text-gold: #f59e0b;
            --divider: rgba(255,255,255,0.06);
            --header-border: rgba(255,255,255,0.05);
            --group-title-color: #64748b;
            --ctrl-bg: rgba(15, 23, 42, 0.92);
            --ctrl-border: rgba(255,255,255,0.12);
        }
        body.theme-mode-light {
            --bg-color: #eef2f7;
            --bg-gradient-1: rgba(99, 102, 241, 0.07);
            --bg-gradient-2: rgba(16, 185, 129, 0.05);
            --card-bg: rgba(255, 255, 255, 0.92);
            --card-border: rgba(15, 23, 42, 0.08);
            --text-main: #0f172a;
            --text-muted: #475569;
            --text-gold: #d97706;
            --divider: rgba(0,0,0,0.06);
            --header-border: rgba(0,0,0,0.05);
            --group-title-color: #94a3b8;
            --ctrl-bg: rgba(255, 255, 255, 0.93);
            --ctrl-border: rgba(15,23,42,0.1);
        }

        /* ─── 12-Color Accent Themes ─── */
        .theme-emerald { --tc: #10b981; --tc-rgb: 16,185,129; --tg: linear-gradient(135deg,#10b981,#059669); }
        .theme-indigo  { --tc: #6366f1; --tc-rgb: 99,102,241; --tg: linear-gradient(135deg,#6366f1,#4f46e5); }
        .theme-violet  { --tc: #8b5cf6; --tc-rgb: 139,92,246; --tg: linear-gradient(135deg,#8b5cf6,#7c3aed); }
        .theme-rose    { --tc: #f43f5e; --tc-rgb: 244,63,94;  --tg: linear-gradient(135deg,#f43f5e,#e11d48); }
        .theme-amber   { --tc: #f59e0b; --tc-rgb: 245,158,11; --tg: linear-gradient(135deg,#f59e0b,#d97706); }
        .theme-sky     { --tc: #0ea5e9; --tc-rgb: 14,165,233; --tg: linear-gradient(135deg,#0ea5e9,#0284c7); }
        .theme-teal    { --tc: #14b8a6; --tc-rgb: 20,184,166; --tg: linear-gradient(135deg,#14b8a6,#0d9488); }
        .theme-fuchsia { --tc: #d946ef; --tc-rgb: 217,70,239; --tg: linear-gradient(135deg,#d946ef,#c026d3); }
        .theme-cyan    { --tc: #06b6d4; --tc-rgb: 6,182,212;  --tg: linear-gradient(135deg,#06b6d4,#0891b2); }
        .theme-lime    { --tc: #84cc16; --tc-rgb: 132,204,22; --tg: linear-gradient(135deg,#84cc16,#65a30d); }
        .theme-orange  { --tc: #f97316; --tc-rgb: 249,115,22; --tg: linear-gradient(135deg,#f97316,#ea580c); }
        .theme-slate   { --tc: #64748b; --tc-rgb: 100,116,139;--tg: linear-gradient(135deg,#64748b,#475569); }

        /* ─── BG Tint Overrides: Dark ─── */
        body.theme-mode-dark .bg-theme-emerald { --card-bg:rgba(6,78,59,.45);  --card-border:rgba(16,185,129,.18); }
        body.theme-mode-dark .bg-theme-indigo  { --card-bg:rgba(49,46,129,.45);--card-border:rgba(99,102,241,.18);}
        body.theme-mode-dark .bg-theme-violet  { --card-bg:rgba(76,29,149,.45);--card-border:rgba(139,92,246,.18);}
        body.theme-mode-dark .bg-theme-rose    { --card-bg:rgba(136,19,55,.45);--card-border:rgba(244,63,94,.18); }
        body.theme-mode-dark .bg-theme-amber   { --card-bg:rgba(120,53,4,.45); --card-border:rgba(245,158,11,.18);}
        body.theme-mode-dark .bg-theme-sky     { --card-bg:rgba(12,74,96,.45); --card-border:rgba(14,165,233,.18);}
        body.theme-mode-dark .bg-theme-teal    { --card-bg:rgba(19,78,74,.45); --card-border:rgba(20,184,166,.18);}
        body.theme-mode-dark .bg-theme-fuchsia { --card-bg:rgba(112,26,117,.45);--card-border:rgba(217,70,239,.18);}
        body.theme-mode-dark .bg-theme-cyan    { --card-bg:rgba(22,78,99,.45); --card-border:rgba(6,182,212,.18); }
        body.theme-mode-dark .bg-theme-lime    { --card-bg:rgba(63,98,18,.45); --card-border:rgba(132,204,22,.18);}
        body.theme-mode-dark .bg-theme-orange  { --card-bg:rgba(124,45,18,.45);--card-border:rgba(249,115,22,.18);}
        body.theme-mode-dark .bg-theme-slate   { --card-bg:rgba(30,41,59,.65); --card-border:rgba(100,116,139,.22);}

        /* ─── BG Tint Overrides: Light ─── */
        body.theme-mode-light .bg-theme-emerald { --card-bg:rgba(209,250,229,.7); --card-border:rgba(16,185,129,.25); }
        body.theme-mode-light .bg-theme-indigo  { --card-bg:rgba(224,231,255,.7); --card-border:rgba(99,102,241,.25); }
        body.theme-mode-light .bg-theme-violet  { --card-bg:rgba(237,233,254,.7); --card-border:rgba(139,92,246,.25); }
        body.theme-mode-light .bg-theme-rose    { --card-bg:rgba(254,226,226,.7); --card-border:rgba(244,63,94,.25);  }
        body.theme-mode-light .bg-theme-amber   { --card-bg:rgba(254,243,199,.7); --card-border:rgba(245,158,11,.25); }
        body.theme-mode-light .bg-theme-sky     { --card-bg:rgba(224,242,254,.7); --card-border:rgba(14,165,233,.25); }
        body.theme-mode-light .bg-theme-teal    { --card-bg:rgba(204,251,241,.7); --card-border:rgba(20,184,166,.25); }
        body.theme-mode-light .bg-theme-fuchsia { --card-bg:rgba(250,232,255,.7); --card-border:rgba(217,70,239,.25); }
        body.theme-mode-light .bg-theme-cyan    { --card-bg:rgba(207,250,254,.7); --card-border:rgba(6,182,212,.25);  }
        body.theme-mode-light .bg-theme-lime    { --card-bg:rgba(236,253,203,.7); --card-border:rgba(132,204,22,.25); }
        body.theme-mode-light .bg-theme-orange  { --card-bg:rgba(255,237,213,.7); --card-border:rgba(249,115,22,.25); }
        body.theme-mode-light .bg-theme-slate   { --card-bg:rgba(226,232,240,.88);--card-border:rgba(100,116,139,.28);}

        /* ─── Base Reset & Full-Viewport Layout ─── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body { height: 100%; width: 100%; overflow: hidden; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            background-image:
                radial-gradient(at 15% 15%, var(--bg-gradient-1) 0px, transparent 55%),
                radial-gradient(at 85% 85%, var(--bg-gradient-2) 0px, transparent 55%);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            height: 100dvh;
            /* extra bottom padding for floating control bar */
            padding: 1.4rem 2rem 5.5rem 2rem;
            transition: background-color 0.7s ease, color 0.7s ease;
        }

        /* ─── Header ─── */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid var(--header-border);
            flex-shrink: 0;
        }

        .header-title-area h1 {
            font-size: clamp(1.4rem, 2.2vw, 2.2rem);
            font-weight: 900;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        body.theme-mode-light .header-title-area h1 {
            background: linear-gradient(to right, #0f172a, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .header-title-area p {
            color: var(--text-gold);
            font-size: clamp(0.7rem, 1vw, 0.9rem);
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 0.15rem;
        }
        .header-right { display: flex; align-items: center; gap: 1rem; }

        .live-btn {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.35);
            color: #ef4444;
            padding: 0.5rem 1rem;
            border-radius: 99px;
            text-decoration: none;
            font-weight: 700;
            font-size: clamp(0.7rem, 0.9vw, 0.85rem);
            display: flex; align-items: center; gap: 0.4rem;
            transition: all 0.3s ease;
        }
        .live-btn:hover { background: #ef4444; color: #fff; }
        .live-btn .dot {
            width: 7px; height: 7px; background: currentColor;
            border-radius: 50%; animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%,100% { transform: scale(0.9); opacity: 1; }
            50% { transform: scale(1.35); opacity: 0.4; }
        }

        .theme-toggle-btn {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            width: 36px; height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none; flex-shrink: 0;
        }
        body.theme-mode-light .theme-toggle-btn { background: rgba(0,0,0,0.05); border-color: rgba(0,0,0,0.1); color: #0f172a; }
        .theme-toggle-btn:hover { transform: scale(1.1); }
        body.theme-mode-dark  .theme-toggle-btn .light-icon { display: block; }
        body.theme-mode-dark  .theme-toggle-btn .dark-icon  { display: none; }
        body.theme-mode-light .theme-toggle-btn .light-icon { display: none; }
        body.theme-mode-light .theme-toggle-btn .dark-icon  { display: block; }

        /* ─── Main Content Flex ─── */
        .tv-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            overflow: hidden;
            padding-top: 0.8rem;
        }

        /* ─── Group Section ─── */
        .group-section {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
        }

        .group-title {
            font-size: clamp(0.6rem, 0.85vw, 0.75rem);
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--group-title-color);
            margin-bottom: 0.5rem;
            display: flex; align-items: center; gap: 0.6rem;
            flex-shrink: 0;
        }
        .group-title::after { content: ''; flex: 1; height: 1px; background: var(--divider); }

        /* ─── Cards Grid ─── */
        .grid-layout {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.9rem;
            flex: 1;
            min-height: 0;
        }
        .grid-layout-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.9rem;
            flex: 1;
            min-height: 0;
        }

        /* ─── Sub-card label inside card ─── */
        .sub-card-label {
            font-size: clamp(0.6rem, 0.78vw, 0.72rem);
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--tc);
            opacity: 0.75;
            margin-bottom: 0.35rem;
            padding-bottom: 0.25rem;
            border-bottom: 1px solid rgba(var(--tc-rgb), 0.2);
            flex-shrink: 0;
        }

        /* ─── Glassmorphism Card ─── */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.1rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
            min-height: 0;
            transition: background 0.5s ease, border-color 0.5s ease;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 3px;
            background: var(--tg);
        }

        .card-title {
            font-size: clamp(0.85rem, 1.15vw, 1.1rem);
            font-weight: 900;
            letter-spacing: 0.03em;
            color: var(--tc);
            text-transform: uppercase;
            flex-shrink: 0;
        }

        /* ─── Progress Items ─── */
        .progress-item {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex-shrink: 0;
        }
        .progress-item + .progress-item {
            padding-top: 0.55rem;
            border-top: 1px solid var(--divider);
        }

        .item-label-row { display: flex; justify-content: space-between; align-items: flex-end; }

        .item-label {
            font-size: clamp(0.7rem, 0.95vw, 0.9rem);
            font-weight: 700; color: var(--text-main); letter-spacing: 0.02em;
        }
        body.theme-mode-light .item-label { color: #334155; }

        .item-sublabel {
            font-size: clamp(0.55rem, 0.75vw, 0.72rem);
            font-weight: 600; color: var(--text-muted); text-transform: uppercase;
        }

        .item-values {
            font-size: clamp(0.8rem, 1.1vw, 1.05rem);
            font-weight: 800; color: var(--text-main); font-variant-numeric: tabular-nums;
        }
        body.theme-mode-light .item-values { color: #0f172a; }

        .item-subvalues {
            font-size: clamp(0.6rem, 0.8vw, 0.77rem);
            font-weight: 600; color: var(--text-muted); margin-right: 0.5rem;
        }

        .progress-bar-container {
            width: 100%; height: 8px; background: var(--divider);
            border-radius: 99px; overflow: hidden;
        }
        body.theme-mode-light .progress-bar-container { background: rgba(0,0,0,0.06); }

        .progress-bar-fill {
            height: 100%; border-radius: 99px; width: 0%;
            background: var(--tg);
            transition: width 0.3s linear;
        }

        .item-status-row {
            display: flex; justify-content: space-between;
            font-size: clamp(0.58rem, 0.78vw, 0.74rem);
            font-weight: 600; color: var(--text-muted);
        }
        .item-pct { color: var(--tc); font-weight: 700; }

        /* ─── Empty Banner ─── */
        .empty-banner {
            grid-column: span 3;
            background: var(--card-bg);
            border: 2px dashed var(--card-border);
            border-radius: 18px;
            padding: 4rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* ─── Floating Playback Controls ─── */
        .playback-controls {
            position: fixed;
            bottom: 1rem;
            left: 2rem;
            right: 2rem;
            background: var(--ctrl-bg);
            border: 1px solid var(--ctrl-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 0.85rem 1.5rem;
            box-shadow: 0 16px 40px rgba(0,0,0,0.5);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }
        body.theme-mode-light .playback-controls { box-shadow: 0 16px 40px rgba(0,0,0,0.12); }

        .play-btn {
            background: #f59e0b;
            color: #fff;
            border: none;
            width: 42px; height: 42px;
            border-radius: 50%;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        body.theme-mode-light .play-btn { background: #0f172a; }
        .play-btn:hover { transform: scale(1.1); }

        .playback-info-area {
            text-align: center;
            min-width: 120px;
            border-right: 1px solid var(--ctrl-border);
            padding-right: 1.25rem;
            flex-shrink: 0;
        }
        .playback-timestamp {
            font-size: clamp(1rem, 1.5vw, 1.3rem);
            font-weight: 800;
            color: var(--text-main);
            font-variant-numeric: tabular-nums;
        }
        .playback-status {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-gold);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .playback-timeline-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .timeline-slider {
            -webkit-appearance: none;
            width: 100%; height: 7px;
            border-radius: 99px;
            background: var(--divider);
            outline: none; cursor: pointer;
        }
        body.theme-mode-light .timeline-slider { background: rgba(0,0,0,0.1); }
        .timeline-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px; height: 18px;
            border-radius: 50%;
            background: #f59e0b;
            cursor: pointer;
        }

        .timeline-labels {
            display: flex; justify-content: space-between;
            font-size: 0.72rem; font-weight: 600;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }

        .speed-control {
            display: flex;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 3px; gap: 2px;
            flex-shrink: 0;
        }
        body.theme-mode-light .speed-control { background: rgba(0,0,0,0.05); border-color: rgba(0,0,0,0.08); }
        .speed-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.78rem;
            padding: 0.4rem 0.75rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .speed-btn.active {
            background: rgba(255,255,255,0.12);
            color: var(--text-main);
        }
        body.theme-mode-light .speed-btn.active {
            background: rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="theme-mode-{{ $state->theme }}">

    <header>
        <div class="header-title-area">
            <h1>Progress Report Qurban Masjid Jogokariyan 1447H</h1>
            <p>Time-Lapse Playback Panel</p>
        </div>
        <div class="header-right">
            <button id="theme-toggle-btn" class="theme-toggle-btn" title="Ubah Tema">
                <span class="dark-icon">🌙</span>
                <span class="light-icon">☀️</span>
            </button>
            <a href="/progressreport" class="live-btn">
                <span class="dot"></span>
                LIVE MONITORING
            </a>
        </div>
    </header>

    <main class="tv-main">

        @if($logs->isEmpty())
            <div class="group-section">
                <div class="grid-layout">
                    <div class="empty-banner">
                        Belum ada data log yang terekam.<br>
                        Silakan update data di panel admin untuk melihat animasi playback.
                    </div>
                </div>
            </div>
        @else

        <!-- Group 1: PROSES QURBAN -->
        <div class="group-section">
            <h2 class="group-title">⚙️ Proses Qurban</h2>
            <div class="grid-layout">

                <!-- Block 1: PENYEMBELIHAN -->
                <div id="card_block_1" class="card theme-{{ $state->color_block_1 }} bg-theme-{{ $state->bg_block_1 ?? 'default' }}">
                    <div class="card-title">Penyembelihan</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI</span>
                            <span id="penyembelihan_sapi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="penyembelihan_sapi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penyembelihan_sapi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="penyembelihan_sapi_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">KAMBING</span>
                            <span id="penyembelihan_kambing_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="penyembelihan_kambing_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penyembelihan_kambing_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="penyembelihan_kambing_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 2: PENGELETAN -->
                <div id="card_block_2" class="card theme-{{ $state->color_block_2 }} bg-theme-{{ $state->bg_block_2 ?? 'default' }}">
                    <div class="card-title">Pengeletan</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">SAPI</span>
                            <span id="pengeletan_sapi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="pengeletan_sapi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="pengeletan_sapi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="pengeletan_sapi_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">KAMBING</span>
                            <span id="pengeletan_kambing_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="pengeletan_kambing_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="pengeletan_kambing_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="pengeletan_kambing_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 3: PENIMBANGAN -->
                <div id="card_block_3" class="card theme-{{ $state->color_block_3 }} bg-theme-{{ $state->bg_block_3 ?? 'default' }}">
                    <div class="card-title">Penimbangan</div>
                    <div class="progress-item">
                        <div class="sub-card-label">SAPI REGULER</div>
                        <div class="item-label-row">
                            <span class="item-label">TERTIMBANG</span>
                            <span id="penimbangan_sapi_reguler_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="penimbangan_sapi_reguler_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penimbangan_sapi_reguler_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="penimbangan_sapi_reguler_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="sub-card-label">SAPI SUPER, DUPER &amp; PRIBADI</div>
                        <div class="item-label-row">
                            <span class="item-label">TERTIMBANG</span>
                            <span id="penimbangan_sapi_khusus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="penimbangan_sapi_khusus_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="penimbangan_sapi_khusus_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="penimbangan_sapi_khusus_time">-</span>)</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Group 2: DISTRIBUSI QURBAN -->
        <div class="group-section">
            <h2 class="group-title">📦 Distribusian Qurban</h2>
            <div class="grid-layout-4">

                <!-- Block 4: SOHIBUL QURBAN SAPI REGULER -->
                <div id="card_block_4" class="card theme-{{ $state->color_block_4 }} bg-theme-{{ $state->bg_block_4 ?? 'default' }}">
                    <div class="card-title">Sohibul Qurban Sapi</div>
                    <div class="sub-card-label">SAPI REGULER</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <div style="text-align:right;">
                                <div class="item-subvalues">Tdk Ambil: <span id="sohibul_sapi_reguler_tidak_diambil_val">0</span></div>
                                <span id="sohibul_sapi_reguler_terbungkus_val" class="item-values">-/-</span>
                            </div>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_sapi_reguler_terbungkus_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_reguler_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_sapi_reguler_terbungkus_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="sohibul_sapi_reguler_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_sapi_reguler_terdistribusi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_reguler_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_sapi_reguler_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 4b: SOHIBUL QURBAN SAPI KHUSUS -->
                <div id="card_block_4b" class="card theme-{{ $state->color_block_4 }} bg-theme-{{ $state->bg_block_4 ?? 'default' }}">
                    <div class="card-title">Sohibul Qurban Sapi</div>
                    <div class="sub-card-label">SAPI SUPER, DUPER &amp; PRIBADI</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <div style="text-align:right;">
                                <div class="item-subvalues">Tdk Ambil: <span id="sohibul_sapi_khusus_tidak_diambil_val">0</span></div>
                                <span id="sohibul_sapi_khusus_terbungkus_val" class="item-values">-/-</span>
                            </div>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_sapi_khusus_terbungkus_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_khusus_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_sapi_khusus_terbungkus_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="sohibul_sapi_khusus_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_sapi_khusus_terdistribusi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_sapi_khusus_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_sapi_khusus_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 5: SOHIBUL QURBAN KAMBING -->
                <div id="card_block_5" class="card theme-{{ $state->color_block_5 }} bg-theme-{{ $state->bg_block_5 ?? 'default' }}">
                    <div class="card-title">Sohibul Qurban Kambing</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <span id="sohibul_kambing_terbungkus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_kambing_terbungkus_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_kambing_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_kambing_terbungkus_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="sohibul_kambing_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="sohibul_kambing_terdistribusi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="sohibul_kambing_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="sohibul_kambing_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

                <!-- Block 6: DISTRIBUSI BUNGKUSAN DAGING -->
                <div id="card_block_6" class="card theme-{{ $state->color_block_6 }} bg-theme-{{ $state->bg_block_6 ?? 'default' }}">
                    <div class="card-title">Distribusi Bungkus Daging</div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERBUNGKUS</span>
                            <span id="bungkusan_daging_terbungkus_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="bungkusan_daging_terbungkus_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="bungkusan_daging_terbungkus_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="bungkusan_daging_terbungkus_time">-</span>)</span>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="item-label-row">
                            <span class="item-label">TERDISTRIBUSI</span>
                            <span id="bungkusan_daging_terdistribusi_val" class="item-values">-/-</span>
                        </div>
                        <div class="progress-bar-container"><div id="bungkusan_daging_terdistribusi_bar" class="progress-bar-fill"></div></div>
                        <div class="item-status-row">
                            <span>PROGRESS <span id="bungkusan_daging_terdistribusi_pct" class="item-pct">0</span>%</span>
                            <span>(<span id="bungkusan_daging_terdistribusi_time">-</span>)</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @endif

    </main>

    <!-- FLOATING PLAYBACK CONTROLS (always visible) -->
    <div class="playback-controls">
        <button id="btn-play" class="play-btn">▶</button>

        <div class="playback-info-area">
            <div id="playback-time" class="playback-timestamp">--:--</div>
            <div id="playback-status" class="playback-status">PAUSED</div>
        </div>

        <div class="playback-timeline-area">
            <input type="range" id="timeline-slider" class="timeline-slider" min="0" max="0" value="0">
            <div class="timeline-labels">
                <span id="time-start">--:--</span>
                <span id="time-end">--:--</span>
            </div>
        </div>

        <div class="speed-control">
            <button class="speed-btn active" data-speed="1">1×</button>
            <button class="speed-btn" data-speed="5">5×</button>
            <button class="speed-btn" data-speed="10">10×</button>
            <button class="speed-btn" data-speed="30">30×</button>
        </div>
    </div>

    @if(!$logs->isEmpty())
    <script id="logs-data" type="application/json">@json($logs)</script>
    @endif

    <script>
        // ─── Theme Toggle ───
        const toggleBtn = document.getElementById('theme-toggle-btn');
        if (toggleBtn) {
            const stored = localStorage.getItem('progress-theme-override');
            if (stored) {
                document.body.classList.remove('theme-mode-dark', 'theme-mode-light');
                document.body.classList.add(`theme-mode-${stored}`);
            }
            toggleBtn.addEventListener('click', () => {
                const isDark = document.body.classList.contains('theme-mode-dark');
                const next = isDark ? 'light' : 'dark';
                document.body.classList.remove('theme-mode-dark', 'theme-mode-light');
                document.body.classList.add(`theme-mode-${next}`);
                localStorage.setItem('progress-theme-override', next);
            });
        }

        // ─── Playback Engine ───
        const logsEl = document.getElementById('logs-data');
        const btnPlay  = document.getElementById('btn-play');
        const slider   = document.getElementById('timeline-slider');
        const lblTime  = document.getElementById('playback-time');
        const lblStatus = document.getElementById('playback-status');
        const lblStart = document.getElementById('time-start');
        const lblEnd   = document.getElementById('time-end');
        const speedBtns = document.querySelectorAll('.speed-btn');

        if (!logsEl) {
            btnPlay.disabled = true;
            lblStatus.textContent = 'NO LOGS';
        } else {
            const logs = JSON.parse(logsEl.textContent);

            if (logs.length > 0) {
                const startMs = new Date(logs[0].created_at).getTime();
                const endMs   = new Date(logs[logs.length - 1].created_at).getTime();
                const startMin = Math.floor(startMs / 60000);
                const endMin   = Math.ceil(endMs / 60000);

                const timeline = [];
                for (let m = startMin; m <= endMin; m++) {
                    const timeMs = m * 60000;
                    const dateObj = new Date(timeMs);
                    let activeLog = logs[0];
                    for (let i = 0; i < logs.length; i++) {
                        if (new Date(logs[i].created_at).getTime() <= timeMs) activeLog = logs[i];
                        else break;
                    }
                    timeline.push({
                        time: dateObj,
                        state: activeLog.state,
                        clock: dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                    });
                }

                let currentIdx = 0, isPlaying = false, playbackSpeed = 1, timer = null;
                let currentLogTheme = null;

                slider.max = timeline.length - 1;
                lblStart.textContent = timeline[0].clock;
                lblEnd.textContent   = timeline[timeline.length - 1].clock;

                function setText(id, v) { const el = document.getElementById(id); if (el) el.textContent = v; }
                function setBar(id, p)  { const el = document.getElementById(id); if (el) el.style.width = p + '%'; }
                function pct(n, d)      { return (!d || d === 0) ? 0 : Math.min(Math.round((n/d)*100), 100); }

                function renderState(idx) {
                    const entry = timeline[idx];
                    const data  = entry.state;
                    lblTime.textContent  = entry.clock;
                    slider.value = idx;

                    if (currentLogTheme !== null && currentLogTheme !== data.theme) {
                        localStorage.removeItem('progress-theme-override');
                    }
                    currentLogTheme = data.theme;
                    if (!localStorage.getItem('progress-theme-override')) {
                        const nm = `theme-mode-${data.theme || 'dark'}`;
                        if (!document.body.classList.contains(nm)) {
                            document.body.classList.remove('theme-mode-dark', 'theme-mode-light');
                            document.body.classList.add(nm);
                        }
                    }

                    for (let i = 1; i <= 6; i++) {
                        const card = document.getElementById(`card_block_${i}`);
                        if (!card) continue;
                        const nt = `theme-${data[`color_block_${i}`] || 'emerald'}`;
                        const nb = `bg-theme-${data[`bg_block_${i}`] || 'default'}`;
                        card.className = card.className.split(' ').filter(c => !c.startsWith('theme-') && !c.startsWith('bg-theme-')).join(' ') + ` ${nt} ${nb}`;
                    }
                    // Sync card_block_4b with block 4 theme
                    const card4b = document.getElementById('card_block_4b');
                    if (card4b) {
                        const nt4b = `theme-${data['color_block_4'] || 'emerald'}`;
                        const nb4b = `bg-theme-${data['bg_block_4'] || 'default'}`;
                        card4b.className = card4b.className.split(' ').filter(c => !c.startsWith('theme-') && !c.startsWith('bg-theme-')).join(' ') + ` ${nt4b} ${nb4b}`;
                    }

                    // Block 1
                    const p1a = pct(data.penyembelihan_sapi_tersembelih, data.penyembelihan_sapi_total);
                    setText('penyembelihan_sapi_val', `${data.penyembelihan_sapi_tersembelih}/${data.penyembelihan_sapi_total}`);
                    setText('penyembelihan_sapi_pct', p1a); setBar('penyembelihan_sapi_bar', p1a);
                    setText('penyembelihan_sapi_time', data.penyembelihan_sapi_time_formatted || '-');
                    const p1b = pct(data.penyembelihan_kambing_tersembelih, data.penyembelihan_kambing_total);
                    setText('penyembelihan_kambing_val', `${data.penyembelihan_kambing_tersembelih}/${data.penyembelihan_kambing_total}`);
                    setText('penyembelihan_kambing_pct', p1b); setBar('penyembelihan_kambing_bar', p1b);
                    setText('penyembelihan_kambing_time', data.penyembelihan_kambing_time_formatted || '-');

                    // Block 2
                    const p2a = pct(data.pengeletan_sapi_terkelet, data.pengeletan_sapi_total);
                    setText('pengeletan_sapi_val', `${data.pengeletan_sapi_terkelet}/${data.pengeletan_sapi_total}`);
                    setText('pengeletan_sapi_pct', p2a); setBar('pengeletan_sapi_bar', p2a);
                    setText('pengeletan_sapi_time', data.pengeletan_sapi_time_formatted || '-');
                    const p2b = pct(data.pengeletan_kambing_terkelet, data.pengeletan_kambing_total);
                    setText('pengeletan_kambing_val', `${data.pengeletan_kambing_terkelet}/${data.pengeletan_kambing_total}`);
                    setText('pengeletan_kambing_pct', p2b); setBar('pengeletan_kambing_bar', p2b);
                    setText('pengeletan_kambing_time', data.pengeletan_kambing_time_formatted || '-');

                    // Block 3
                    const p3a = pct(data.penimbangan_sapi_reguler_tertimbang, data.penimbangan_sapi_reguler_total);
                    setText('penimbangan_sapi_reguler_val', `${data.penimbangan_sapi_reguler_tertimbang}/${data.penimbangan_sapi_reguler_total}`);
                    setText('penimbangan_sapi_reguler_pct', p3a); setBar('penimbangan_sapi_reguler_bar', p3a);
                    setText('penimbangan_sapi_reguler_time', data.penimbangan_sapi_reguler_time_formatted || '-');
                    const p3b = pct(data.penimbangan_sapi_khusus_tertimbang, data.penimbangan_sapi_khusus_total);
                    setText('penimbangan_sapi_khusus_val', `${data.penimbangan_sapi_khusus_tertimbang}/${data.penimbangan_sapi_khusus_total}`);
                    setText('penimbangan_sapi_khusus_pct', p3b); setBar('penimbangan_sapi_khusus_bar', p3b);
                    setText('penimbangan_sapi_khusus_time', data.penimbangan_sapi_khusus_time_formatted || '-');

                    // Block 4
                    const p4a = pct(data.sohibul_sapi_reguler_terbungkus, data.sohibul_sapi_reguler_total);
                    setText('sohibul_sapi_reguler_tidak_diambil_val', data.sohibul_sapi_reguler_tidak_diambil);
                    setText('sohibul_sapi_reguler_terbungkus_val', `${data.sohibul_sapi_reguler_terbungkus}/${data.sohibul_sapi_reguler_total}`);
                    setText('sohibul_sapi_reguler_terbungkus_pct', p4a); setBar('sohibul_sapi_reguler_terbungkus_bar', p4a);
                    setText('sohibul_sapi_reguler_terbungkus_time', data.sohibul_sapi_reguler_terbungkus_time_formatted || '-');
                    const denomRD = data.sohibul_sapi_reguler_total - data.sohibul_sapi_reguler_tidak_diambil;
                    const p4b = pct(data.sohibul_sapi_reguler_terdistribusi, denomRD);
                    setText('sohibul_sapi_reguler_terdistribusi_val', `${data.sohibul_sapi_reguler_terdistribusi}/${denomRD}`);
                    setText('sohibul_sapi_reguler_terdistribusi_pct', p4b); setBar('sohibul_sapi_reguler_terdistribusi_bar', p4b);
                    setText('sohibul_sapi_reguler_terdistribusi_time', data.sohibul_sapi_reguler_terdistribusi_time_formatted || '-');
                    const p4c = pct(data.sohibul_sapi_khusus_terbungkus, data.sohibul_sapi_khusus_total);
                    setText('sohibul_sapi_khusus_tidak_diambil_val', data.sohibul_sapi_khusus_tidak_diambil);
                    setText('sohibul_sapi_khusus_terbungkus_val', `${data.sohibul_sapi_khusus_terbungkus}/${data.sohibul_sapi_khusus_total}`);
                    setText('sohibul_sapi_khusus_terbungkus_pct', p4c); setBar('sohibul_sapi_khusus_terbungkus_bar', p4c);
                    setText('sohibul_sapi_khusus_terbungkus_time', data.sohibul_sapi_khusus_terbungkus_time_formatted || '-');
                    const denomKD = data.sohibul_sapi_khusus_total - data.sohibul_sapi_khusus_tidak_diambil;
                    const p4d = pct(data.sohibul_sapi_khusus_terdistribusi, denomKD);
                    setText('sohibul_sapi_khusus_terdistribusi_val', `${data.sohibul_sapi_khusus_terdistribusi}/${denomKD}`);
                    setText('sohibul_sapi_khusus_terdistribusi_pct', p4d); setBar('sohibul_sapi_khusus_terdistribusi_bar', p4d);
                    setText('sohibul_sapi_khusus_terdistribusi_time', data.sohibul_sapi_khusus_terdistribusi_time_formatted || '-');

                    // Block 5
                    const p5a = pct(data.sohibul_kambing_terbungkus, data.sohibul_kambing_total);
                    setText('sohibul_kambing_terbungkus_val', `${data.sohibul_kambing_terbungkus}/${data.sohibul_kambing_total}`);
                    setText('sohibul_kambing_terbungkus_pct', p5a); setBar('sohibul_kambing_terbungkus_bar', p5a);
                    setText('sohibul_kambing_terbungkus_time', data.sohibul_kambing_terbungkus_time_formatted || '-');
                    const p5b = pct(data.sohibul_kambing_terdistribusi, data.sohibul_kambing_total);
                    setText('sohibul_kambing_terdistribusi_val', `${data.sohibul_kambing_terdistribusi}/${data.sohibul_kambing_total}`);
                    setText('sohibul_kambing_terdistribusi_pct', p5b); setBar('sohibul_kambing_terdistribusi_bar', p5b);
                    setText('sohibul_kambing_terdistribusi_time', data.sohibul_kambing_terdistribusi_time_formatted || '-');

                    // Block 6
                    const p6a = pct(data.bungkusan_daging_terbungkus, data.bungkusan_daging_total);
                    setText('bungkusan_daging_terbungkus_val', `${data.bungkusan_daging_terbungkus}/${data.bungkusan_daging_total}`);
                    setText('bungkusan_daging_terbungkus_pct', p6a); setBar('bungkusan_daging_terbungkus_bar', p6a);
                    setText('bungkusan_daging_terbungkus_time', data.bungkusan_daging_terbungkus_time_formatted || '-');
                    const p6b = pct(data.bungkusan_daging_terdistribusi, data.bungkusan_daging_total);
                    setText('bungkusan_daging_terdistribusi_val', `${data.bungkusan_daging_terdistribusi}/${data.bungkusan_daging_total}`);
                    setText('bungkusan_daging_terdistribusi_pct', p6b); setBar('bungkusan_daging_terdistribusi_bar', p6b);
                    setText('bungkusan_daging_terdistribusi_time', data.bungkusan_daging_terdistribusi_time_formatted || '-');
                }

                function pausePlayback() {
                    isPlaying = false;
                    btnPlay.textContent = '▶';
                    lblStatus.textContent = 'PAUSED';
                    if (timer) { clearInterval(timer); timer = null; }
                }

                function playPlayback() {
                    isPlaying = true;
                    btnPlay.textContent = '❚❚';
                    lblStatus.textContent = 'PLAYING';
                    const ms = Math.round(1000 / playbackSpeed);
                    timer = setInterval(() => {
                        if (currentIdx >= timeline.length - 1) { pausePlayback(); return; }
                        currentIdx++;
                        renderState(currentIdx);
                    }, ms);
                }

                btnPlay.addEventListener('click', () => {
                    if (isPlaying) { pausePlayback(); }
                    else {
                        if (currentIdx >= timeline.length - 1) currentIdx = 0;
                        playPlayback();
                    }
                });

                slider.addEventListener('input', (e) => {
                    pausePlayback();
                    currentIdx = parseInt(e.target.value);
                    renderState(currentIdx);
                });

                speedBtns.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        speedBtns.forEach(b => b.classList.remove('active'));
                        e.target.classList.add('active');
                        playbackSpeed = parseInt(e.target.getAttribute('data-speed'));
                        if (isPlaying) { pausePlayback(); playPlayback(); }
                    });
                });

                renderState(0);
            } else {
                lblStatus.textContent = 'NO LOGS';
                btnPlay.disabled = true;
            }
        }
    </script>
</body>
</html>
