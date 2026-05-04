<x-filament-panels::page>

@php
    $markers = $this->getMarkers();
    $stats   = $this->getStats();
    $apiKey  = $this->getApiKey();
    $markersJson = json_encode($markers, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
@endphp

{{-- ── Stats Bar (Filament Native UI) ─────────────────────────────── --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Sohibul</p>
        <p class="text-3xl font-semibold text-gray-950 dark:text-white mt-2">{{ $stats['total'] }}</p>
    </div>
    
    <div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ada Koordinat</p>
        <p class="text-3xl font-semibold text-primary-600 dark:text-primary-400 mt-2">{{ $stats['mapped'] }}</p>
    </div>

    <div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex items-center gap-2">
            <span class="inline-block w-3 h-3 rounded-full bg-danger-500"></span>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum Diproses</p>
        </div>
        <p class="text-3xl font-semibold text-gray-950 dark:text-white mt-2">{{ $stats['belum'] }}</p>
    </div>

    <div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex items-center gap-2">
            <span class="inline-block w-3 h-3 rounded-full bg-warning-500"></span>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sedang Diproses</p>
        </div>
        <p class="text-3xl font-semibold text-gray-950 dark:text-white mt-2">{{ $stats['proses'] }}</p>
    </div>

    <div class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex items-center gap-2">
            <span class="inline-block w-3 h-3 rounded-full bg-success-500"></span>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Selesai</p>
        </div>
        <p class="text-3xl font-semibold text-gray-950 dark:text-white mt-2">{{ $stats['selesai'] }}</p>
    </div>
</div>

{{-- ── Legend & Filter Controls ────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 bg-white p-4 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
    {{-- Legend --}}
    <div class="flex flex-wrap items-center gap-4 text-sm">
        <span class="font-medium text-gray-700 dark:text-gray-200">Filter Peta:</span>
    </div>

    {{-- Filter Buttons (Using Filament Button styles) --}}
    <div class="flex items-center gap-2" id="filter-controls">
        <button onclick="filterMarkers('all')" id="btn-all" class="filter-btn active-filter-btn px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-transparent">
            Semua
        </button>
        <button onclick="filterMarkers(0)" id="btn-0" class="filter-btn px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-transparent">
            Belum
        </button>
        <button onclick="filterMarkers(1)" id="btn-1" class="filter-btn px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-transparent">
            Proses
        </button>
        <button onclick="filterMarkers(2)" id="btn-2" class="filter-btn px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-transparent">
            Selesai
        </button>
    </div>
</div>

{{-- ── Map Container ───────────────────────────────────────────────── --}}
<div class="relative rounded-xl overflow-hidden bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="height:600px;">

    {{-- Marker Count Badge --}}
    <div id="marker-count-badge"
         class="absolute bottom-6 left-6 z-[1000] bg-white dark:bg-gray-900 px-4 py-2 rounded-lg shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 text-sm font-medium text-gray-700 dark:text-gray-200">
        Memuat peta...
    </div>

    @if (empty($apiKey))
        {{-- ── Tanpa API Key: fallback list ── --}}
        <div class="flex flex-col items-center justify-center h-full bg-gray-50 dark:bg-gray-900 gap-4 p-6">
            <x-heroicon-o-map class="w-12 h-12 text-gray-400"/>
            <div class="text-center">
                <p class="font-medium text-gray-950 dark:text-white">Geoapify API Key belum dikonfigurasi</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Tambahkan di file <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded text-xs border border-gray-200 dark:border-gray-700">.env</code>:
                </p>
                <code class="inline-block mt-3 bg-gray-950 text-primary-400 text-xs font-mono px-4 py-2 rounded-lg">
                    GEOAPIFY_API_KEY=your_api_key_here
                </code>
            </div>
        </div>
    @else
        <div id="sohibul-map" style="height:100%;width:100%;z-index:1;"></div>
    @endif
</div>

<div class="mt-4 text-xs text-gray-500 dark:text-gray-400 flex items-center justify-center gap-1">
    Sistem peta didukung oleh <a href="https://leafletjs.com" target="_blank" class="text-primary-600 hover:underline">Leaflet.js</a> & <a href="https://www.geoapify.com/" target="_blank" class="text-primary-600 hover:underline">Geoapify</a>.
</div>

{{-- ── Styles ──────────────────────────────────────────────────────── --}}
<style>
/* Leaflet CSS */
@import url('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');

.filter-btn {
    color: #4b5563;
}
.dark .filter-btn { color: #9ca3af; }
.filter-btn:hover { background-color: #f3f4f6; color: #111827; }
.dark .filter-btn:hover { background-color: rgba(255,255,255,0.05); color: #f9fafb; }
.active-filter-btn {
    background-color: rgba(var(--primary-600), 0.1) !important;
    color: rgb(var(--primary-600)) !important;
    border-color: rgba(var(--primary-600), 0.2) !important;
}
.dark .active-filter-btn {
    background-color: rgba(var(--primary-500), 0.15) !important;
    color: rgb(var(--primary-400)) !important;
    border-color: rgba(var(--primary-500), 0.3) !important;
}

/* Custom Leaflet popup */
.leaflet-popup-content-wrapper {
    border-radius: 0.75rem !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    padding: 0 !important;
    overflow: hidden;
    background: #ffffff !important;
}
.dark .leaflet-popup-content-wrapper {
    background: #111827 !important;
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #f3f4f6;
}
.leaflet-popup-tip-container { overflow: visible !important; }
.leaflet-popup-tip {
    background: #ffffff !important;
}
.dark .leaflet-popup-tip {
    background: #111827 !important;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-top: none; border-left: none;
}
.leaflet-popup-content {
    margin: 0 !important;
    min-width: 240px;
}
.popup-inner {
    padding: 1rem;
    font-family: inherit;
    font-size: 0.875rem;
    color: #111827;
}
.dark .popup-inner { color: #f9fafb; }
.popup-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f3f4f6;
}
.dark .popup-header { border-bottom-color: rgba(255,255,255,0.1); }
.popup-dot {
    width: 0.75rem; height: 0.75rem;
    border-radius: 9999px;
    flex-shrink: 0;
}
.popup-name {
    font-weight: 600;
    font-size: 0.875rem;
    line-height: 1.25;
}
.popup-grid {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0.375rem 0.75rem;
    color: #4b5563;
    font-size: 0.8125rem;
}
.dark .popup-grid { color: #d1d5db; }
.popup-label { color: #6b7280; font-weight: 500; }
.dark .popup-label { color: #9ca3af; }
.popup-badge {
    display: inline-block;
    padding: 0.125rem 0.5rem;
    border-radius: 9999px;
    font-weight: 500;
    font-size: 0.75rem;
}
.popup-footer {
    margin-top: 0.875rem;
    padding-top: 0.75rem;
    border-top: 1px solid #f3f4f6;
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}
.dark .popup-footer { border-top-color: rgba(255,255,255,0.1); }
.popup-link {
    font-size: 0.8125rem;
    font-weight: 500;
    text-decoration: none;
}
.popup-link:hover { text-decoration: underline; }

/* Layer switcher custom */
.layer-control-panel {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 4px;
    background: #ffffff;
    padding: 4px;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.05);
}
.dark .layer-control-panel {
    background: #111827;
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.layer-btn {
    display: block;
    background: transparent;
    border-radius: 0.375rem;
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 500;
    color: #4b5563;
    cursor: pointer;
    text-align: left;
}
.dark .layer-btn { color: #d1d5db; }
.layer-btn:hover { background: #f3f4f6; color: #111827; }
.dark .layer-btn:hover { background: rgba(255,255,255,0.05); color: #f9fafb; }
.layer-btn.active-layer { background: rgba(var(--primary-600), 0.1); color: rgb(var(--primary-600)); }
.dark .layer-btn.active-layer { background: rgba(var(--primary-500), 0.15); color: rgb(var(--primary-400)); }
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
        0: { color: 'rgb(239, 68, 68)', border: '#ffffff', badgeBg: 'rgba(239, 68, 68, 0.1)', badgeText: 'rgb(220, 38, 38)', label: 'Belum Diproses' },
        1: { color: 'rgb(245, 158, 11)', border: '#ffffff', badgeBg: 'rgba(245, 158, 11, 0.1)', badgeText: 'rgb(217, 119, 6)', label: 'Sedang Diproses' },
        2: { color: 'rgb(34, 197, 94)', border: '#ffffff', badgeBg: 'rgba(34, 197, 94, 0.1)', badgeText: 'rgb(22, 163, 74)', label: 'Selesai' },
    };
    
    const isDark = document.documentElement.classList.contains('dark');
    if (isDark) {
        STATUS[0].border = '#111827'; STATUS[0].badgeText = 'rgb(248, 113, 113)';
        STATUS[1].border = '#111827'; STATUS[1].badgeText = 'rgb(251, 191, 36)';
        STATUS[2].border = '#111827'; STATUS[2].badgeText = 'rgb(74, 222, 128)';
    }

    // ── Tile layers (Geoapify) ────────────────────────────────────
    const TILE_LAYERS = {
        'roadmap': {
            label : 'Peta Jalan',
            url   : `https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© Geoapify',
        },
        'satellite': {
            label : 'Satelit',
            url   : `https://maps.geoapify.com/v1/tile/satellite/{z}/{x}/{y}.jpg?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© Geoapify',
        },
        'dark': {
            label : 'Gelap',
            url   : `https://maps.geoapify.com/v1/tile/dark-matter/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`,
            attr  : '© Geoapify',
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
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 32 42">
            <path d="M16 0C9.37 0 4 5.37 4 12c0 9 12 30 12 30S28 21 28 12C28 5.37 22.63 0 16 0z"
                  fill="${s.color}" stroke="${s.border}" stroke-width="2"/>
            <circle cx="16" cy="12" r="5" fill="white"/>
        </svg>`;
        return L.icon({
            iconUrl    : 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg),
            iconSize   : [30, 40],
            iconAnchor : [15, 40],
            popupAnchor: [0, -36],
        });
    }

    // ── Popup HTML factory ────────────────────────────────────────
    function makePopup(d) {
        const s    = STATUS[d.status] ?? STATUS[0];
        const nohpRaw = d.nohp ? d.nohp.toString().replace(/\D/g, '').replace(/^0/, '') : '';
        const waLink  = nohpRaw
            ? `<a href="https://wa.me/62${nohpRaw}" target="_blank" class="popup-link" style="color:rgb(16, 185, 129)">WhatsApp</a>`
            : '';
        const mapsLink = `<a href="${d.urlmap}" target="_blank" class="popup-link" style="color:rgb(59, 130, 246)">Buka Maps</a>`;

        return `<div class="popup-inner">
            <div class="popup-header">
                <div class="popup-dot" style="background:${s.color}"></div>
                <div class="popup-name">${d.nama}</div>
            </div>
            <div class="popup-grid">
                <span class="popup-label">No.</span>
                <span><strong>${d.no}</strong></span>
                <span class="popup-label">Paket</span>
                <span>${d.jenis}</span>
                <span class="popup-label">RT/RW</span>
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
            .bindPopup(makePopup(d), { maxWidth: 300, minWidth: 240 });
        return { marker, data: d };
    });

    if (allMarkers.length > 0) {
        const group = L.featureGroup(allMarkers.map(m => m.marker));
        map.fitBounds(group.getBounds().pad(0.1));
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
        if (badge) badge.textContent = `Menampilkan ${visible} titik lokasi`;
    }

});
</script>
@endif

</x-filament-panels::page>
