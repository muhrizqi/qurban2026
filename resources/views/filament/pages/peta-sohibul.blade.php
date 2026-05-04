<x-filament-panels::page>

@php
    $markers = $this->getMarkers();
    $stats   = $this->getStats();
    $apiKey  = $this->getApiKey();
    $markersJson = json_encode($markers, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
@endphp

{{-- ── Stats Bar ──────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
    <!-- Total -->
    <div class="relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-gray-200/50 dark:bg-gray-700/50 rounded-full blur-xl group-hover:scale-110 transition-transform duration-500"></div>
        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 relative z-10">Total Sohibul</p>
        <p class="text-3xl font-black text-gray-800 dark:text-white relative z-10">{{ $stats['total'] }}</p>
    </div>

    <!-- Mapped -->
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/40 dark:to-blue-900/20 rounded-2xl border border-blue-200 dark:border-blue-800 p-5 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-400/20 rounded-full blur-xl group-hover:scale-110 transition-transform duration-500"></div>
        <p class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2 relative z-10">Ada Koordinat</p>
        <p class="text-3xl font-black text-blue-700 dark:text-blue-300 relative z-10">{{ $stats['mapped'] }}</p>
    </div>

    <!-- Belum -->
    <div class="relative overflow-hidden bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/40 dark:to-red-900/20 rounded-2xl border border-red-200 dark:border-red-800 p-5 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-400/20 rounded-full blur-xl group-hover:scale-110 transition-transform duration-500"></div>
        <p class="text-xs font-semibold text-red-600 dark:text-red-400 uppercase tracking-wider mb-2 relative z-10">Belum Diproses</p>
        <div class="flex items-end justify-between relative z-10">
            <p class="text-3xl font-black text-red-700 dark:text-red-300">{{ $stats['belum'] }}</p>
            <span class="text-xl mb-1 drop-shadow-sm">🔴</span>
        </div>
    </div>

    <!-- Proses -->
    <div class="relative overflow-hidden bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/40 dark:to-amber-900/20 rounded-2xl border border-amber-200 dark:border-amber-800 p-5 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-400/20 rounded-full blur-xl group-hover:scale-110 transition-transform duration-500"></div>
        <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 uppercase tracking-wider mb-2 relative z-10">Diproses</p>
        <div class="flex items-end justify-between relative z-10">
            <p class="text-3xl font-black text-amber-700 dark:text-amber-300">{{ $stats['proses'] }}</p>
            <span class="text-xl mb-1 drop-shadow-sm">🟡</span>
        </div>
    </div>

    <!-- Selesai -->
    <div class="relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/40 dark:to-green-900/20 rounded-2xl border border-green-200 dark:border-green-800 p-5 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-400/20 rounded-full blur-xl group-hover:scale-110 transition-transform duration-500"></div>
        <p class="text-xs font-semibold text-green-600 dark:text-green-400 uppercase tracking-wider mb-2 relative z-10">Selesai</p>
        <div class="flex items-end justify-between relative z-10">
            <p class="text-3xl font-black text-green-700 dark:text-green-300">{{ $stats['selesai'] }}</p>
            <span class="text-xl mb-1 drop-shadow-sm">🟢</span>
        </div>
    </div>
</div>

{{-- ── Legend & Filter Controls ────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 bg-white dark:bg-gray-800/50 p-4 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm backdrop-blur-md">
    {{-- Legend --}}
    <div class="flex flex-wrap items-center gap-4 text-sm">
        <span class="font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
            <x-heroicon-s-information-circle class="w-5 h-5 text-blue-500"/> Legenda:
        </span>
        <span class="flex items-center gap-2 px-3 py-1.5 bg-red-50 dark:bg-red-900/30 rounded-full border border-red-100 dark:border-red-800/50">
            <span class="inline-block w-3 h-3 rounded-full bg-red-500 shadow-sm shadow-red-500/50"></span>
            <span class="text-red-700 dark:text-red-300 font-semibold text-xs">Belum</span>
        </span>
        <span class="flex items-center gap-2 px-3 py-1.5 bg-amber-50 dark:bg-amber-900/30 rounded-full border border-amber-100 dark:border-amber-800/50">
            <span class="inline-block w-3 h-3 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span>
            <span class="text-amber-700 dark:text-amber-300 font-semibold text-xs">Proses</span>
        </span>
        <span class="flex items-center gap-2 px-3 py-1.5 bg-green-50 dark:bg-green-900/30 rounded-full border border-green-100 dark:border-green-800/50">
            <span class="inline-block w-3 h-3 rounded-full bg-green-500 shadow-sm shadow-green-500/50"></span>
            <span class="text-green-700 dark:text-green-300 font-semibold text-xs">Selesai</span>
        </span>
    </div>

    {{-- Filter Buttons --}}
    <div class="flex items-center gap-2 p-1.5 bg-gray-100 dark:bg-gray-900/60 rounded-xl border border-gray-200 dark:border-gray-800" id="filter-controls">
        <button onclick="filterMarkers('all')" id="btn-all"
            class="filter-btn active-filter-btn px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
            Semua
        </button>
        <button onclick="filterMarkers(0)" id="btn-0"
            class="filter-btn px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
            Belum
        </button>
        <button onclick="filterMarkers(1)" id="btn-1"
            class="filter-btn px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
            Proses
        </button>
        <button onclick="filterMarkers(2)" id="btn-2"
            class="filter-btn px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
            Selesai
        </button>
    </div>
</div>

{{-- ── Map Container ───────────────────────────────────────────────── --}}
<div class="relative rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-xl ring-1 ring-black/5" style="height:650px;">

    {{-- Marker Count Badge --}}
    <div id="marker-count-badge"
         style="position:absolute;bottom:24px;left:24px;z-index:1000;
                background:rgba(255,255,255,0.95);border:1px solid #e5e7eb;
                border-radius:12px;padding:8px 16px;font-size:13px;
                font-weight:700;color:#1f2937;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
                backdrop-filter:blur(8px);">
        📍 Memuat peta...
    </div>

    @if (empty($apiKey))
        {{-- ── Tanpa API Key: fallback list ── --}}
        <div class="flex flex-col items-center justify-center h-full bg-gray-50 dark:bg-gray-900 gap-4 p-6">
            <x-heroicon-o-map class="w-16 h-16 text-gray-400"/>
            <div class="text-center">
                <p class="font-semibold text-gray-600 dark:text-gray-300">Geoapify API Key belum dikonfigurasi</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Daftar gratis di
                    <a href="https://www.geoapify.com/" target="_blank" class="text-blue-500 hover:text-blue-600 underline font-semibold">geoapify.com</a>
                    lalu tambahkan di file <code class="bg-gray-200 dark:bg-gray-800 px-1.5 py-0.5 rounded text-xs border border-gray-300 dark:border-gray-700">.env</code>:
                </p>
                <code class="inline-block mt-3 bg-gray-900 text-green-400 text-xs font-mono px-4 py-2.5 rounded-xl shadow-inner border border-gray-800">
                    GEOAPIFY_API_KEY=your_api_key_here
                </code>
                <p class="text-xs text-gray-400 mt-3">Free tier: 3.000 tile requests/hari. Tidak perlu kartu kredit.</p>
            </div>

            @if (count($markers) > 0)
            <div class="mt-4 w-full max-w-3xl overflow-y-auto max-h-[28rem] px-2 custom-scrollbar">
                <p class="text-xs font-medium text-gray-400 dark:text-gray-500 mb-3 text-center uppercase tracking-wider">{{ count($markers) }} sohibul dengan koordinat ditemukan:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($markers as $m)
                    <a href="{{ $m['urlmap'] }}" target="_blank"
                       class="flex items-start gap-3 bg-white dark:bg-gray-800 rounded-xl p-3 text-sm shadow-sm
                              border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all hover:shadow-md group">
                        <span class="text-xl flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                            @if ($m['status'] === 0) 🔴
                            @elseif ($m['status'] === 1) 🟡
                            @else 🟢
                            @endif
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-900 dark:text-white leading-tight truncate">{{ $m['nama'] }}</p>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-1">{{ $m['no'] }}</p>
                            <span class="inline-block mt-1.5 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider
                                @if($m['status']===0) bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300
                                @elseif($m['status']===1) bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300
                                @else bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300 @endif">
                                {{ $m['statusLabel'] }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    @else
        <div id="sohibul-map" style="height:100%;width:100%;z-index:1;"></div>
    @endif
</div>

<div class="flex items-center justify-center gap-2 mt-4 text-xs font-medium text-gray-500 dark:text-gray-400">
    <x-heroicon-s-map class="w-4 h-4 text-gray-400"/>
    <p>
        Sistem Peta menggunakan <a href="https://leafletjs.com" target="_blank" class="text-blue-500 hover:underline">Leaflet.js</a>
        & <a href="https://www.geoapify.com/" target="_blank" class="text-blue-500 hover:underline">Geoapify</a>. 
        Menampilkan <span class="font-bold text-gray-700 dark:text-gray-300">{{ count($markers) }}</span> dari {{ $stats['total'] }} sohibul.
    </p>
</div>

{{-- ── Styles ──────────────────────────────────────────────────────── --}}
<style>
/* Leaflet CSS */
@import url('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');

.filter-btn {
    color: #6b7280;
    background: transparent;
}
.dark .filter-btn { color: #9ca3af; }
.filter-btn:hover { color: #111827; }
.dark .filter-btn:hover { color: #f3f4f6; }
.active-filter-btn {
    background: #ffffff !important;
    color: #111827 !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
}
.dark .active-filter-btn {
    background: #374151 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
}

/* Custom Scrollbar for fallback list */
.custom-scrollbar::-webkit-scrollbar { width: 6px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
.dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; }

/* Custom Leaflet popup */
.leaflet-popup-content-wrapper {
    border-radius: 16px !important;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1) !important;
    padding: 0 !important;
    overflow: hidden;
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.95) !important;
    border: 1px solid rgba(255,255,255,0.2);
}
.dark .leaflet-popup-content-wrapper {
    background: rgba(31, 41, 55, 0.95) !important;
    border: 1px solid rgba(255,255,255,0.05);
    color: #f3f4f6;
}
.leaflet-popup-tip-container { overflow: visible !important; }
.leaflet-popup-tip {
    background: rgba(255, 255, 255, 0.95) !important;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1) !important;
}
.dark .leaflet-popup-tip {
    background: rgba(31, 41, 55, 0.95) !important;
}
.leaflet-popup-content {
    margin: 0 !important;
    min-width: 240px;
}
.popup-inner {
    padding: 16px 20px;
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    font-size: 13px;
    color: #111827;
}
.dark .popup-inner { color: #f3f4f6; }
.popup-header {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f3f4f6;
}
.dark .popup-header { border-bottom-color: #374151; }
.popup-dot {
    width: 14px; height: 14px;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 2px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.popup-name {
    font-weight: 800;
    font-size: 15px;
    line-height: 1.3;
}
.popup-grid {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 6px 12px;
    color: #4b5563;
    font-size: 13px;
}
.dark .popup-grid { color: #d1d5db; }
.popup-label { color: #9ca3af; font-weight: 500; }
.dark .popup-label { color: #6b7280; }
.popup-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.popup-footer {
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid #f3f4f6;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.dark .popup-footer { border-top-color: #374151; }
.popup-link {
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: opacity 0.2s;
}
.popup-link:hover { opacity: 0.7; }

/* Layer switcher custom */
.layer-control-panel {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.layer-btn {
    display: block;
    background: rgba(255,255,255,0.95);
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 8px 14px;
    font-size: 12px;
    font-weight: 700;
    color: #4b5563;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    text-align: left;
    backdrop-filter: blur(8px);
}
.dark .layer-btn {
    background: rgba(31, 41, 55, 0.95);
    border-color: #374151;
    color: #d1d5db;
}
.layer-btn:hover { background: #f9fafb; border-color: #3b82f6; color: #3b82f6; transform: translateX(-2px); }
.dark .layer-btn:hover { background: #1f2937; border-color: #60a5fa; color: #60a5fa; }
.layer-btn.active-layer { background: #3b82f6; color: #fff; border-color: #3b82f6; box-shadow: 0 4px 6px -1px rgba(59,130,246,0.3); }
.dark .layer-btn.active-layer { background: #2563eb; border-color: #2563eb; }
</style>

{{-- ── Leaflet + Geoapify Script ───────────────────────────────────── --}}
@if (!empty($apiKey))
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const GEOAPIFY_KEY = '{{ $apiKey }}';
    const RAW_MARKERS  = {!! $markersJson !!};

    // ── Status config ─────────────────────────────────────────────
    const STATUS = {
        0: { color: '#ef4444', border: '#b91c1c', badgeBg: '#fee2e2', badgeText: '#b91c1c', label: 'Belum Diproses' },
        1: { color: '#f59e0b', border: '#b45309', badgeBg: '#fef3c7', badgeText: '#b45309', label: 'Sedang Diproses' },
        2: { color: '#22c55e', border: '#15803d', badgeBg: '#dcfce7', badgeText: '#15803d', label: 'Selesai' },
    };
    
    // Auto-adjust status colors for dark mode
    const isDark = document.documentElement.classList.contains('dark');
    if (isDark) {
        STATUS[0].badgeBg = 'rgba(153, 27, 27, 0.3)'; STATUS[0].badgeText = '#fca5a5';
        STATUS[1].badgeBg = 'rgba(146, 64, 14, 0.3)'; STATUS[1].badgeText = '#fcd34d';
        STATUS[2].badgeBg = 'rgba(22, 101, 52, 0.3)'; STATUS[2].badgeText = '#86efac';
    }

    // ── Tile layers (Geoapify) ────────────────────────────────────
    const TILE_LAYERS = {
        'roadmap': {
            label : '🗺️ Peta',
            url   : `https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© <a href="https://www.geoapify.com/">Geoapify</a> © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        },
        'toner': {
            label : '⬛ Toner',
            url   : `https://maps.geoapify.com/v1/tile/toner/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© <a href="https://www.geoapify.com/">Geoapify</a> © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        },
        'satellite': {
            label : '🛰️ Satelit',
            url   : `https://maps.geoapify.com/v1/tile/satellite/{z}/{x}/{y}.jpg?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© <a href="https://www.geoapify.com/">Geoapify</a>',
        },
        'dark': {
            label : '🌙 Dark',
            url   : `https://maps.geoapify.com/v1/tile/dark-matter/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© <a href="https://www.geoapify.com/">Geoapify</a> © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        },
        'terrain': {
            label : '⛰️ Terrain',
            url   : `https://maps.geoapify.com/v1/tile/klokantech-terrain/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© <a href="https://www.geoapify.com/">Geoapify</a> © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        },
    };

    // ── Init Leaflet map ──────────────────────────────────────────
    const defaultCenter = RAW_MARKERS.length > 0
        ? [RAW_MARKERS[0].lat, RAW_MARKERS[0].lng]
        : [-7.8014, 110.3649];

    const map = L.map('sohibul-map', {
        center     : defaultCenter,
        zoom       : 14,
        zoomControl: true,
    });

    let activeLayerKey = isDark ? 'dark' : 'roadmap';
    let currentTile = L.tileLayer(TILE_LAYERS[activeLayerKey].url, {
        attribution : TILE_LAYERS[activeLayerKey].attr,
        maxZoom     : 20,
    }).addTo(map);

    // ── Layer Switcher UI ─────────────────────────────────────────
    const layerPanel = document.createElement('div');
    layerPanel.className = 'layer-control-panel';

    Object.entries(TILE_LAYERS).forEach(([key, cfg]) => {
        const btn = document.createElement('button');
        btn.className = 'layer-btn' + (key === activeLayerKey ? ' active-layer' : '');
        btn.id        = 'layer-' + key;
        btn.textContent = cfg.label;
        btn.onclick = function () {
            if (key === activeLayerKey) return;
            map.removeLayer(currentTile);
            currentTile = L.tileLayer(cfg.url, { attribution: cfg.attr, maxZoom: 20 }).addTo(map);
            activeLayerKey = key;
            document.querySelectorAll('.layer-btn').forEach(b => b.classList.remove('active-layer'));
            btn.classList.add('active-layer');
        };
        layerPanel.appendChild(btn);
    });

    document.getElementById('sohibul-map').appendChild(layerPanel);

    // ── SVG marker factory ────────────────────────────────────────
    function makeIcon(statusCode) {
        const s   = STATUS[statusCode] ?? STATUS[0];
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="46" viewBox="0 0 32 42">
            <path d="M16 0C9.37 0 4 5.37 4 12c0 9 12 30 12 30S28 21 28 12C28 5.37 22.63 0 16 0z"
                  fill="${s.color}" stroke="#ffffff" stroke-width="2" filter="drop-shadow(0px 2px 3px rgba(0,0,0,0.3))"/>
            <circle cx="16" cy="12" r="5.5" fill="white" opacity="0.95"/>
        </svg>`;
        return L.icon({
            iconUrl    : 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg),
            iconSize   : [36, 46],
            iconAnchor : [18, 46],
            popupAnchor: [0, -42],
        });
    }

    // ── Popup HTML factory ────────────────────────────────────────
    function makePopup(d) {
        const s    = STATUS[d.status] ?? STATUS[0];
        const nohpRaw = d.nohp ? d.nohp.toString().replace(/\D/g, '').replace(/^0/, '') : '';
        const waLink  = nohpRaw
            ? `<a href="https://wa.me/62${nohpRaw}" target="_blank" class="popup-link" style="color:#10b981">💬 WhatsApp</a>`
            : '';
        const mapsLink = `<a href="${d.urlmap}" target="_blank" class="popup-link" style="color:#3b82f6">📍 Buka di Maps</a>`;

        return `<div class="popup-inner">
            <div class="popup-header">
                <div class="popup-dot" style="background:${s.color}"></div>
                <div class="popup-name">${d.nama}</div>
            </div>
            <div class="popup-grid">
                <span class="popup-label">No. ID</span>
                <span><strong style="color:#3b82f6">${d.no}</strong></span>
                <span class="popup-label">Paket</span>
                <span>${d.jenis}</span>
                <span class="popup-label">RT / RW</span>
                <span>RT ${d.rt} / RW ${d.rw ?? '-'}</span>
                <span class="popup-label">Alamat</span>
                <span>${d.alamat}</span>
                <span class="popup-label">Bagian</span>
                <span>${d.bagian}</span>
                <span class="popup-label">Status</span>
                <span>
                    <span class="popup-badge" style="background:${s.badgeBg};color:${s.badgeText}">
                        ${d.statusLabel}
                    </span>
                </span>
            </div>
            <div class="popup-footer">
                ${waLink}
                ${mapsLink}
            </div>
        </div>`;
    }

    // ── Buat markers ──────────────────────────────────────────────
    const allMarkers = RAW_MARKERS.map(d => {
        const marker = L.marker([d.lat, d.lng], { icon: makeIcon(d.status), title: `[${d.no}] ${d.nama}` })
            .addTo(map)
            .bindPopup(makePopup(d), { maxWidth: 320, minWidth: 260 });
        return { marker, data: d };
    });

    // ── Auto fit bounds ───────────────────────────────────────────
    if (allMarkers.length > 0) {
        const group = L.featureGroup(allMarkers.map(m => m.marker));
        map.fitBounds(group.getBounds().pad(0.15));
    }

    updateBadge();

    // ── Filter markers ────────────────────────────────────────────
    let activeFilter = 'all';

    window.filterMarkers = function (status) {
        activeFilter = status;

        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter-btn'));
        const activeBtn = document.getElementById('btn-' + status);
        if (activeBtn) activeBtn.classList.add('active-filter-btn');

        allMarkers.forEach(({ marker, data }) => {
            const show = status === 'all' || data.status === status;
            if (show) {
                if (!map.hasLayer(marker)) map.addLayer(marker);
            } else {
                if (map.hasLayer(marker)) map.removeLayer(marker);
            }
        });

        updateBadge();
    };

    function updateBadge() {
        const visible = allMarkers.filter(({ marker }) => map.hasLayer(marker)).length;
        const badge   = document.getElementById('marker-count-badge');
        if (badge) badge.textContent = `📍 Menampilkan ${visible} dari ${allMarkers.length} titik lokasi`;
    }

}); // end DOMContentLoaded
</script>
@endif

</x-filament-panels::page>
