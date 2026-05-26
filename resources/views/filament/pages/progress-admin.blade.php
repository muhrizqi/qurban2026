<x-filament-panels::page>
    @php
        // Harmonious curated color palette – 12 options
        $colorMap = [
            'emerald' => [
                'border' => 'border-t-emerald-500',
                'bg'     => 'bg-emerald-50 dark:bg-emerald-950/20',
                'text'   => 'text-emerald-700 dark:text-emerald-400',
                'dot'    => 'bg-emerald-500',
                'badge'  => 'background:#d1fae5;color:#065f46;border-color:#6ee7b7;',
            ],
            'indigo' => [
                'border' => 'border-t-indigo-500',
                'bg'     => 'bg-indigo-50 dark:bg-indigo-950/20',
                'text'   => 'text-indigo-700 dark:text-indigo-400',
                'dot'    => 'bg-indigo-500',
                'badge'  => 'background:#e0e7ff;color:#3730a3;border-color:#a5b4fc;',
            ],
            'violet' => [
                'border' => 'border-t-violet-500',
                'bg'     => 'bg-violet-50 dark:bg-violet-950/20',
                'text'   => 'text-violet-700 dark:text-violet-400',
                'dot'    => 'bg-violet-500',
                'badge'  => 'background:#ede9fe;color:#5b21b6;border-color:#c4b5fd;',
            ],
            'rose' => [
                'border' => 'border-t-rose-500',
                'bg'     => 'bg-rose-50 dark:bg-rose-950/20',
                'text'   => 'text-rose-700 dark:text-rose-400',
                'dot'    => 'bg-rose-500',
                'badge'  => 'background:#ffe4e6;color:#9f1239;border-color:#fca5a5;',
            ],
            'amber' => [
                'border' => 'border-t-amber-500',
                'bg'     => 'bg-amber-50 dark:bg-amber-950/20',
                'text'   => 'text-amber-700 dark:text-amber-400',
                'dot'    => 'bg-amber-500',
                'badge'  => 'background:#fef3c7;color:#92400e;border-color:#fcd34d;',
            ],
            'sky' => [
                'border' => 'border-t-sky-500',
                'bg'     => 'bg-sky-50 dark:bg-sky-950/20',
                'text'   => 'text-sky-700 dark:text-sky-400',
                'dot'    => 'bg-sky-500',
                'badge'  => 'background:#e0f2fe;color:#075985;border-color:#7dd3fc;',
            ],
            'teal' => [
                'border' => 'border-t-teal-500',
                'bg'     => 'bg-teal-50 dark:bg-teal-950/20',
                'text'   => 'text-teal-700 dark:text-teal-400',
                'dot'    => 'bg-teal-500',
                'badge'  => 'background:#ccfbf1;color:#134e4a;border-color:#5eead4;',
            ],
            'fuchsia' => [
                'border' => 'border-t-fuchsia-500',
                'bg'     => 'bg-fuchsia-50 dark:bg-fuchsia-950/20',
                'text'   => 'text-fuchsia-700 dark:text-fuchsia-400',
                'dot'    => 'bg-fuchsia-500',
                'badge'  => 'background:#fae8ff;color:#86198f;border-color:#e879f9;',
            ],
            'cyan' => [
                'border' => 'border-t-cyan-500',
                'bg'     => 'bg-cyan-50 dark:bg-cyan-950/20',
                'text'   => 'text-cyan-700 dark:text-cyan-400',
                'dot'    => 'bg-cyan-500',
                'badge'  => 'background:#cffafe;color:#164e63;border-color:#67e8f9;',
            ],
            'lime' => [
                'border' => 'border-t-lime-500',
                'bg'     => 'bg-lime-50 dark:bg-lime-950/20',
                'text'   => 'text-lime-700 dark:text-lime-400',
                'dot'    => 'bg-lime-500',
                'badge'  => 'background:#ecfccb;color:#3a5212;border-color:#bef264;',
            ],
            'orange' => [
                'border' => 'border-t-orange-500',
                'bg'     => 'bg-orange-50 dark:bg-orange-950/20',
                'text'   => 'text-orange-700 dark:text-orange-400',
                'dot'    => 'bg-orange-500',
                'badge'  => 'background:#ffedd5;color:#7c2d12;border-color:#fdba74;',
            ],
            'slate' => [
                'border' => 'border-t-slate-500',
                'bg'     => 'bg-slate-50 dark:bg-slate-900/40',
                'text'   => 'text-slate-700 dark:text-slate-400',
                'dot'    => 'bg-slate-500',
                'badge'  => 'background:#f1f5f9;color:#334155;border-color:#94a3b8;',
            ],
        ];

        // Curated harmonious defaults per block:
        // Block 1 Penyembelihan → Emerald
        // Block 2 Pengeletan → Indigo
        // Block 3 Penimbangan → Violet
        // Block 4 Sohibul Sapi → Sky
        // Block 5 Sohibul Kambing → Amber
        // Block 6 Distribusi Daging → Teal

        $c1 = $colorMap[$color_block_1] ?? $colorMap['emerald'];
        $c2 = $colorMap[$color_block_2] ?? $colorMap['indigo'];
        $c3 = $colorMap[$color_block_3] ?? $colorMap['violet'];
        $c4 = $colorMap[$color_block_4] ?? $colorMap['sky'];
        $c5 = $colorMap[$color_block_5] ?? $colorMap['amber'];
        $c6 = $colorMap[$color_block_6] ?? $colorMap['teal'];

        $colorOptions = [
            'emerald' => '💚 Emerald',
            'indigo'  => '💙 Indigo',
            'violet'  => '💜 Violet',
            'rose'    => '❤️ Rose',
            'amber'   => '💛 Amber',
            'sky'     => '🩵 Sky',
            'teal'    => '💚 Teal',
            'fuchsia' => '💜 Fuchsia',
            'cyan'    => '🩵 Cyan',
            'lime'    => '💚 Lime',
            'orange'  => '🧡 Orange',
            'slate'   => '🩶 Slate',
        ];
        $bgOptions = array_merge(['default' => '✨ Default (Glass)'], $colorOptions);
    @endphp

    <style>
        /* Match data-online page style */
        .pa-stat {
            border-radius: 14px;
            padding: 14px 18px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            color: #fff;
        }
        .pa-stat-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-bottom: 4px;
            opacity: .85;
        }
        .pa-stat-value {
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
        }
        .pa-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            border: 1px solid transparent;
        }
        .pa-block-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg, #f8fafc, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-bottom: none;
            border-radius: 12px 12px 0 0;
            padding: 10px 14px;
        }
        .dark .pa-block-header {
            background: linear-gradient(90deg, rgb(17 24 39 / 0.8), rgb(31 41 55 / 0.8));
            border-color: rgb(55 65 81);
        }
        .pa-block-body {
            border: 1px solid #e2e8f0;
            border-radius: 0 0 12px 12px;
            overflow: hidden;
            margin-bottom: 0;
        }
        .dark .pa-block-body {
            border-color: rgb(55 65 81);
        }
        .pa-select {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
            font-weight: 600;
            outline: none;
            cursor: pointer;
        }
        .dark .pa-select {
            background: rgb(31 41 55);
            border-color: rgb(75 85 99);
            color: #e5e7eb;
        }
        .pa-select:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245,158,11,.15);
        }
        .pa-section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        /* Prominent block title bar */
        .pa-block-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding: 8px 12px;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(0,0,0,0.04), transparent);
            border-left: 4px solid currentColor;
        }
        .dark .pa-block-title {
            background: linear-gradient(90deg, rgba(255,255,255,0.05), transparent);
        }
        .pa-block-title-text {
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            line-height: 1.2;
        }
        .pa-block-title .pa-badge {
            margin-left: auto;
        }
        .pa-divider {
            width: 100%;
            height: 1px;
            background: #e2e8f0;
            margin: 10px 0;
        }
        .dark .pa-divider {
            background: rgb(55 65 81);
        }
        .pa-inner-wrap {
            padding: 14px;
        }
        .pa-group-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg, #f8fafc, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-bottom: none;
            border-radius: 12px 12px 0 0;
            padding: 10px 14px;
            font-weight: 700;
            font-size: 13px;
            color: #334155;
        }
        .dark .pa-group-title {
            background: linear-gradient(90deg, rgb(17 24 39 / 0.8), rgb(31 41 55 / 0.8));
            border-color: rgb(55 65 81);
            color: #e5e7eb;
        }
    </style>

    <div class="space-y-5">

        {{-- ── HEADER STAT CARDS ── --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;">
            <div class="pa-stat" style="background:linear-gradient(135deg,#1e293b,#0f172a);">
                <div class="pa-stat-label">TV Dashboard</div>
                <div style="display:flex;gap:8px;margin-top:8px;flex-wrap:wrap;">
                    <a href="/progressreport" target="_blank"
                       style="display:inline-flex;align-items:center;gap:5px;background:#f59e0b;color:#fff;font-size:11px;font-weight:700;padding:5px 11px;border-radius:8px;text-decoration:none;">
                        🖥️ Live TV
                    </a>
                    <a href="/progressreport/playback" target="_blank"
                       style="display:inline-flex;align-items:center;gap:5px;background:#6366f1;color:#fff;font-size:11px;font-weight:700;padding:5px 11px;border-radius:8px;text-decoration:none;">
                        🎞️ Playback
                    </a>
                </div>
            </div>

            <div class="pa-stat" style="background:linear-gradient(135deg,#0369a1,#0284c7);">
                <div class="pa-stat-label">Tampilan TV</div>
                <select wire:model.live="theme"
                        style="margin-top:6px;font-size:12px;padding:5px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.25);background:rgba(255,255,255,0.15);color:#fff;font-weight:700;outline:none;width:100%;cursor:pointer;">
                    <option value="dark" style="background:#1e293b;">🌑 Dark Mode</option>
                    <option value="light" style="background:#1e293b;">☀️ Light Mode</option>
                </select>
            </div>

            <div class="pa-stat" style="background:linear-gradient(135deg,#dc2626,#b91c1c);">
                <div class="pa-stat-label">Bahaya</div>
                <div style="display:flex;gap:8px;margin-top:8px;flex-wrap:wrap;">
                    <button wire:click="resetProgress"
                            wire:confirm="Apakah Anda yakin ingin RESET semua data progress qurban menjadi 0 dan menghapus semua timestamp? Tindakan ini tidak bisa dibatalkan!"
                            type="button"
                            style="display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.3);color:#fff;font-size:11px;font-weight:700;padding:5px 11px;border-radius:8px;cursor:pointer;">
                        🔄 Reset Progress
                    </button>
                    <button wire:click="clearLogs"
                            wire:confirm="Apakah Anda yakin ingin menghapus SEMUA data log? Semua animasi playback dari awal akan hilang dan tidak bisa dipulihkan!"
                            type="button"
                            style="display:inline-flex;align-items:center;gap:5px;background:rgba(0,0,0,0.25);border:1px solid rgba(255,255,255,0.2);color:#fff;font-size:11px;font-weight:700;padding:5px 11px;border-radius:8px;cursor:pointer;">
                        🗑️ Hapus Log
                    </button>
                </div>
            </div>
        </div>

        {{-- ── GROUP 1: PROSES QURBAN ── --}}
        <div>
            <div class="pa-group-title">
                <span>⚙️ Proses Qurban</span>
                <span style="font-size:11px;font-weight:600;color:#6b7280;">3 Proses Utama</span>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:0 0 12px 12px;overflow:hidden;" class="dark:border-gray-700">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:0;">

                    {{-- BLOCK 1: PENYEMBELIHAN --}}
                    <div style="border-right:1px solid #e2e8f0;" class="dark:border-gray-700">
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c1['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c1['dot'] }}"></span>
                                <span class="pa-block-title-text">1. Penyembelihan</span>
                                <span class="pa-badge" style="{{ $c1['badge'] }}">{{ ucfirst($color_block_1) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_1" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_1" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_sapi_tersembelih'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_sapi_total'])
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_kambing_tersembelih'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_kambing_total'])
                        </div>
                    </div>

                    {{-- BLOCK 2: PENGELETAN --}}
                    <div style="border-right:1px solid #e2e8f0;" class="dark:border-gray-700">
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c2['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c2['dot'] }}"></span>
                                <span class="pa-block-title-text">2. Pengeletan</span>
                                <span class="pa-badge" style="{{ $c2['badge'] }}">{{ ucfirst($color_block_2) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_2" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_2" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_sapi_terkelet'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_sapi_total'])
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_kambing_terkelet'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_kambing_total'])
                        </div>
                    </div>

                    {{-- BLOCK 3: PENIMBANGAN --}}
                    <div>
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c3['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c3['dot'] }}"></span>
                                <span class="pa-block-title-text">3. Penimbangan</span>
                                <span class="pa-badge" style="{{ $c3['badge'] }}">{{ ucfirst($color_block_3) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_3" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_3" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi Reguler</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_reguler_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_reguler_total'])
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi Khusus (Super/Duper/PB)</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_khusus_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_khusus_total'])
                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_kambing_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_kambing_total'])
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── GROUP 2: DISTRIBUSI QURBAN ── --}}
        <div>
            <div class="pa-group-title">
                <span>📦 Distribusi Qurban</span>
                <span style="font-size:11px;font-weight:600;color:#6b7280;">3 Saluran Distribusi</span>
            </div>
            <div style="border:1px solid #e2e8f0;border-radius:0 0 12px 12px;overflow:hidden;" class="dark:border-gray-700">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:0;">

                    {{-- BLOCK 4: SOHIBUL QURBAN SAPI --}}
                    <div style="border-right:1px solid #e2e8f0;" class="dark:border-gray-700">
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c4['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c4['dot'] }}"></span>
                                <span class="pa-block-title-text">4. Sohibul Qurban Sapi</span>
                                <span class="pa-badge" style="{{ $c4['badge'] }}">{{ ucfirst($color_block_4) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_4" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_4" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button wire:click="updateBlock4FromDatabase" type="button"
                                style="width:100%;display:flex;justify-content:center;align-items:center;gap:6px;padding:7px 12px;font-size:11px;font-weight:700;color:#fff;background:#4f46e5;border-radius:9px;border:none;cursor:pointer;margin-bottom:10px;">
                                🔄 Sinkronisasi dari Database Sohibul
                            </button>

                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi Reguler</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_reguler_terbungkus'])
                            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px;margin-top:8px;">
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Total</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_reguler_total }}</div>
                                </div>
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Tdk Ambil</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_reguler_tidak_diambil }}</div>
                                </div>
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Terdistribusi</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_reguler_terdistribusi }}</div>
                                </div>
                            </div>

                            <div class="pa-divider"></div>
                            <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:6px;">Sapi Khusus (Super/Duper/PB)</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_khusus_terbungkus'])
                            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px;margin-top:8px;">
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Total</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_khusus_total }}</div>
                                </div>
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Tdk Ambil</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_khusus_tidak_diambil }}</div>
                                </div>
                                <div style="padding:6px 8px;background:#f9fafb;border-radius:8px;text-align:center;" class="dark:bg-gray-800">
                                    <div style="font-size:9px;font-weight:700;color:#6b7280;text-transform:uppercase;">Terdistribusi</div>
                                    <div style="font-size:12px;font-weight:800;color:#111827;" class="dark:text-white">{{ $sohibul_sapi_khusus_terdistribusi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BLOCK 5: SOHIBUL QURBAN KAMBING --}}
                    <div style="border-right:1px solid #e2e8f0;" class="dark:border-gray-700">
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c5['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c5['dot'] }}"></span>
                                <span class="pa-block-title-text">5. Sohibul Qurban Kambing</span>
                                <span class="pa-badge" style="{{ $c5['badge'] }}">{{ ucfirst($color_block_5) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_5" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_5" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pa-divider"></div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus', 'field' => 'sohibul_kambing_terbungkus'])
                            @include('filament.pages.progress-input-row', ['label' => 'Terdistribusi', 'field' => 'sohibul_kambing_terdistribusi'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'sohibul_kambing_total'])
                        </div>
                    </div>

                    {{-- BLOCK 6: DISTRIBUSI BUNGKUSAN DAGING --}}
                    <div>
                        <div class="pa-inner-wrap">
                            <div class="pa-block-title {{ $c6['text'] }}" style="border-left-color:currentColor;">
                                <span class="w-3 h-3 rounded-full inline-block flex-shrink-0 {{ $c6['dot'] }}"></span>
                                <span class="pa-block-title-text">6. Distribusi Daging</span>
                                <span class="pa-badge" style="{{ $c6['badge'] }}">{{ ucfirst($color_block_6) }}</span>
                            </div>
                            <div style="display:flex;gap:6px;align-items:center;margin-bottom:10px;">
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Accent Warna</div>
                                    <select wire:model.live="color_block_6" class="pa-select" style="width:100%;">
                                        @foreach($colorOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;">
                                    <div style="font-size:10px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:3px;">Background</div>
                                    <select wire:model.live="bg_block_6" class="pa-select" style="width:100%;">
                                        @foreach($bgOptions as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pa-divider"></div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus', 'field' => 'bungkusan_daging_terbungkus'])
                            @include('filament.pages.progress-input-row', ['label' => 'Terdistribusi', 'field' => 'bungkusan_daging_terdistribusi'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Bungkusan', 'field' => 'bungkusan_daging_total'])
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>
