<x-filament-panels::page>

@php
    $markers = $this->getMarkers();
    $stats   = $this->getStats();
    $apiKey  = $this->getApiKey();
    $markersJson = json_encode($markers, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
@endphp

{{-- ── Filter Controls (di atas peta) ──────────────────────────────── --}}
<div class="flex flex-wrap items-center gap-2 mb-3" id="filter-controls">
    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Filter:</label>
    <button onclick="filterMarkers('all')" id="btn-all"
        class="filter-btn active-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
        Semua
    </button>
    <button onclick="filterMarkers(0)" id="btn-0"
        class="filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
        Belum
    </button>
    <button onclick="filterMarkers(1)" id="btn-1"
        class="filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
        Proses
    </button>
    <button onclick="filterMarkers(2)" id="btn-2"
        class="filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
        Selesai
    </button>
    @if(auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']))
    <button onclick="filterMarkers('my')" id="btn-my"
        class="filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-all"
        style="background:#3b82f6;color:#fff;">
        &#128100; Tugasku
    </button>
    @endif
</div>

{{-- ── Map Container ───────────────────────────────────────────────── --}}
<div id="sohibul-map-wrapper" wire:ignore class="relative rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg" style="height:600px;">

    {{-- Marker Count Badge --}}
    <div id="marker-count-badge"
         style="position:absolute;top:12px;left:12px;z-index:1000;
                background:rgba(255,255,255,0.93);border:1px solid #e5e7eb;
                border-radius:10px;padding:6px 12px;font-size:12px;
                font-weight:600;color:#374151;box-shadow:0 1px 6px rgba(0,0,0,0.12);">
        📍 Memuat peta...
    </div>

    @if (empty($apiKey))
        {{-- ── Tanpa API Key: fallback list ── --}}
        <div class="flex flex-col items-center justify-center h-full bg-gray-100 dark:bg-gray-800 gap-4 p-6">
            <x-heroicon-o-map class="w-16 h-16 text-gray-400"/>
            <div class="text-center">
                <p class="font-semibold text-gray-600 dark:text-gray-300">Geoapify API Key belum dikonfigurasi</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Daftar gratis di
                    <a href="https://www.geoapify.com/" target="_blank" class="text-blue-500 underline font-semibold">geoapify.com</a>
                    lalu tambahkan di file <code class="bg-gray-200 dark:bg-gray-700 px-1.5 py-0.5 rounded text-xs">.env</code>:
                </p>
                <code class="inline-block mt-2 bg-gray-800 text-green-400 text-xs px-4 py-2 rounded-lg">
                    GEOAPIFY_API_KEY=your_api_key_here
                </code>
                <p class="text-xs text-gray-400 mt-2">Free tier: 3.000 tile requests/hari. Tidak perlu kartu kredit.</p>
            </div>

            @if (count($markers) > 0)
            <div class="mt-2 w-full max-w-2xl overflow-y-auto max-h-64">
                <p class="text-xs text-gray-400 mb-2 text-center">{{ count($markers) }} sohibul dengan koordinat:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach ($markers as $m)
                    <a href="{{ $m['urlmap'] }}" target="_blank"
                       class="flex items-center gap-2 bg-white dark:bg-gray-900 rounded-lg px-3 py-2 text-sm
                              border border-gray-200 dark:border-gray-700 hover:border-blue-400 transition-colors">
                        <span class="text-base flex-shrink-0">
                            @if ($m['status'] === 0) 🔴
                            @elseif ($m['status'] === 1) 🟡
                            @else 🟢
                            @endif
                        </span>
                        <div class="min-w-0">
                            <p class="font-medium text-gray-800 dark:text-white leading-tight truncate">{{ $m['nama'] }}</p>
                            <p class="text-xs text-gray-500">{{ $m['no'] }} · {{ $m['statusLabel'] }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    @else
        <div id="sohibul-map" style="height:100%;width:100%;"></div>
    @endif
</div>

{{-- ── Info & Stats di bawah peta ─────────────────────────────────── --}}
<p class="text-xs text-gray-400 dark:text-gray-500 mt-3 mb-4 text-center sm:text-left">
    Hanya sohibul dengan URL Google Maps yang ditampilkan ({{ count($markers) }} dari {{ $stats['total'] }}).
</p>

{{-- Stats Bar --}}
<div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mb-4">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex flex-col items-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Sohibul</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 p-4 flex flex-col items-center">
        <p class="text-xs text-blue-600 dark:text-blue-400 mb-1">Ada Koordinat</p>
        <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $stats['mapped'] }}</p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex flex-col items-center">
        <span class="text-lg mb-1">&#9898;</span>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Belum Diproses</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['belum'] }}</p>
    </div>
    <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800 p-4 flex flex-col items-center">
        <span class="text-lg mb-1">&#128993;</span>
        <p class="text-xs text-amber-600 dark:text-amber-400 mb-1">Sedang Diproses</p>
        <p class="text-2xl font-bold text-amber-700 dark:text-amber-300">{{ $stats['proses'] }}</p>
    </div>
    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800 p-4 flex flex-col items-center">
        <span class="text-lg mb-1">&#128994;</span>
        <p class="text-xs text-green-600 dark:text-green-400 mb-1">Selesai</p>
        <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $stats['selesai'] }}</p>
    </div>
</div>

{{-- Legend / Keterangan --}}
<div class="flex flex-wrap items-center gap-4 text-sm px-1">
    <span class="font-semibold text-gray-600 dark:text-gray-300">Keterangan warna marker:</span>
    <span class="flex items-center gap-1.5">
        <span class="inline-block w-4 h-4 rounded-full border-2 border-white shadow" style="background:#ef4444"></span>
        <span class="text-gray-600 dark:text-gray-300">Belum Diproses</span>
    </span>
    <span class="flex items-center gap-1.5">
        <span class="inline-block w-4 h-4 rounded-full border-2 border-white shadow" style="background:#f59e0b"></span>
        <span class="text-gray-600 dark:text-gray-300">Sedang Diproses</span>
    </span>
    <span class="flex items-center gap-1.5">
        <span class="inline-block w-4 h-4 rounded-full border-2 border-white shadow" style="background:#22c55e"></span>
        <span class="text-gray-600 dark:text-gray-300">Selesai</span>
    </span>
</div>

{{-- ── Styles ──────────────────────────────────────────────────────── --}}
<style>
/* Leaflet CSS */
@import url('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');

.filter-btn {
    background: #e5e7eb;
    color: #374151;
}
.filter-btn:hover { opacity: 0.85; }
.active-filter-btn {
    background: #1f2937 !important;
    color: #ffffff !important;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

/* ── Cegah browser-level pinch zoom pada container peta ──────────────
   touch-action: none  → serahkan semua gesture ke Leaflet, bukan browser.
   Tanpa ini, browser bisa CSS-scale seluruh halaman saat pinch,
   sehingga tile layer dan marker layer meleset dari posisinya. */
#sohibul-map-wrapper,
#sohibul-map {
    touch-action: none;
    -ms-touch-action: none;
    /* Matikan user-select agar long-press tidak mengganggu drag peta */
    -webkit-user-select: none;
    user-select: none;
}

/* Custom Leaflet popup */
.leaflet-popup-content-wrapper {
    border-radius: 12px !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
    padding: 0 !important;
    overflow: hidden;
}
.leaflet-popup-content {
    margin: 0 !important;
    min-width: 220px;
}
.popup-inner {
    padding: 14px 16px;
    font-family: system-ui, -apple-system, sans-serif;
    font-size: 13px;
    color: #111827;
}
.popup-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    padding-bottom: 8px;
    border-bottom: 1px solid #f3f4f6;
}
.popup-dot {
    width: 12px; height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}
.popup-name {
    font-weight: 700;
    font-size: 14px;
    line-height: 1.3;
}
.popup-grid {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 4px 10px;
    color: #374151;
    font-size: 12px;
}
.popup-label { color: #9ca3af; }
.popup-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 11px;
}
.popup-footer {
    margin-top: 10px;
    padding-top: 8px;
    border-top: 1px solid #f3f4f6;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.popup-link {
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
}

/* ── Cluster Carousel Popup Nav ────────────────────────────────────── */
.cluster-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f9fafb;
    padding: 8px 12px;
    /* padding-right lebih besar agar tombol › tidak berdesakan
       dengan tombol × Leaflet yang ada di sudut kanan atas popup */
    padding-right: 40px;
    border-bottom: 1px solid #e5e7eb;
    gap: 8px;
}
.cluster-nav-btn {
    background: #1f2937;
    color: #fff;
    border: none;
    border-radius: 6px;
    width: 30px;
    height: 30px;
    font-size: 20px;
    font-weight: 700;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s, transform 0.1s;
    flex-shrink: 0;
}
.cluster-nav-btn:hover   { background: #374151; }
.cluster-nav-btn:active  { transform: scale(0.93); }
.cluster-nav-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    gap: 4px;
}
.cluster-nav-label {
    font-size: 12px;
    font-weight: 700;
    color: #374151;
    white-space: nowrap;
}
.cluster-nav-dots {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
    justify-content: center;
    max-width: 120px;
}
.cluster-nav-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #d1d5db;
    transition: background 0.2s, transform 0.2s;
    cursor: pointer;
}
.cluster-nav-dot.active {
    background: #1f2937;
    transform: scale(1.25);
}

/* ── Leaflet close button: lebih rapi, bulat, terpisah dari nav ──────
   Default Leaflet menempatkan × di top:0, right:0 tanpa background.
   Kita perbaiki agar terlihat jelas sebagai tombol tersendiri. */
.leaflet-popup-close-button {
    top: 7px !important;
    right: 7px !important;
    width: 24px !important;
    height: 24px !important;
    font-size: 16px !important;
    line-height: 24px !important;
    text-align: center !important;
    color: #6b7280 !important;
    background: #fff !important;
    border-radius: 50% !important;
    box-shadow: 0 1px 4px rgba(0,0,0,0.15) !important;
    padding: 0 !important;
    border: 1px solid #e5e7eb !important;
    transition: background 0.15s, color 0.15s !important;
    z-index: 1010 !important;
}
.leaflet-popup-close-button:hover {
    background: #f3f4f6 !important;
    color: #111827 !important;
}


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

    // ── Init Leaflet map ──────────────────────────────────────────
    // Default center: Jogokariyan, Yogyakarta
    const defaultCenter = RAW_MARKERS.length > 0
        ? [RAW_MARKERS[0].lat, RAW_MARKERS[0].lng]
        : [-7.8014, 110.3649];

    const MAP_MAX_ZOOM = 20;
    const MAP_MIN_ZOOM = 10;

    const map = L.map('sohibul-map', {
        center           : defaultCenter,
        zoom             : 14,
        minZoom          : MAP_MIN_ZOOM,
        maxZoom          : MAP_MAX_ZOOM,
        zoomControl      : true,
        attributionControl: false, // Sembunyikan tulisan Leaflet, geoapify, openstreet, dan bendera
        // Batasi zoom gesture di HP (touch) agar tidak melampaui maxZoom
        touchZoom        : true,
        bounceAtZoomLimits: true,
    });

    // ── Paksa kembali ke batas jika Leaflet zoom melampaui batas ────
    map.on('zoomend', function () {
        const z = map.getZoom();
        if (z > MAP_MAX_ZOOM) map.setZoom(MAP_MAX_ZOOM, { animate: false });
        if (z < MAP_MIN_ZOOM) map.setZoom(MAP_MIN_ZOOM, { animate: false });
    });

    // ── Cegah BROWSER-LEVEL pinch zoom pada container peta ───────────
    // Skenario masalah: browser men-CSS-scale seluruh halaman saat pinch,
    // sehingga tile layer dan marker tidak ikut di-recalculate → posisi meleset.
    // Solusi: intercept event touch multi-jari sebelum browser memprosesnya.
    const mapEl = map.getContainer();

    // (1) Safari/iOS: gesturestart & gesturechange adalah event zoom-specific
    mapEl.addEventListener('gesturestart',  function (e) { e.preventDefault(); }, { passive: false });
    mapEl.addEventListener('gesturechange', function (e) { e.preventDefault(); }, { passive: false });
    mapEl.addEventListener('gestureend',    function (e) { e.preventDefault(); }, { passive: false });

    // (2) Android Chrome & browser lain: touchmove dengan 2+ jari = pinch
    //     preventDefault() di sini mencegah browser men-scale halaman;
    //     Leaflet tetap bisa handle zoom-nya sendiri lewat listener internalnya.
    mapEl.addEventListener('touchmove', function (e) {
        if (e.touches.length >= 2) {
            e.preventDefault();
        }
    }, { passive: false });

    // (3) Setelah resize window (misal: rotate HP), paksa Leaflet recalculate
    //     ukuran container agar posisi layer kembali benar.
    window.addEventListener('resize', function () {
        clearTimeout(window._mapResizeTimer);
        window._mapResizeTimer = setTimeout(function () {
            map.invalidateSize();
        }, 200);
    });

    // Pasang tile layer default
    L.tileLayer(`https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`, {
        maxZoom: MAP_MAX_ZOOM,
        minZoom: MAP_MIN_ZOOM,
    }).addTo(map);



    // ── Drone Image Overlay (Orthomosaic Jogokariyan) ─────────────
    const droneUrl = '{{ asset("images/drone.jpg") }}';
    const droneBounds = [
        [-7.8277660612048, 110.36035892223], // Kiri Bawah (SouthWest)
        [-7.8212767462448, 110.36813197759]  // Kanan Atas (NorthEast)
    ];
    
    // Create the overlay but make it a toggleable layer in the future if needed
    // For now, it will always be visible on top of the base map
    const droneLayer = L.imageOverlay(droneUrl, droneBounds, {
        opacity: 0.95,
        interactive: false,
        zIndex: 10
    }).addTo(map);

    // ── SVG marker factory ────────────────────────────────────────
    function makeIcon(statusCode) {
        const s   = STATUS[statusCode] ?? STATUS[0];
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="42" viewBox="0 0 32 42">
            <path d="M16 0C9.37 0 4 5.37 4 12c0 9 12 30 12 30S28 21 28 12C28 5.37 22.63 0 16 0z"
                  fill="${s.color}" stroke="${s.border}" stroke-width="2"/>
            <circle cx="16" cy="12" r="6" fill="white" opacity="0.9"/>
        </svg>`;
        return L.icon({
            iconUrl    : 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg),
            iconSize   : [32, 42],
            iconAnchor : [16, 42],
            popupAnchor: [0, -40],
        });
    }

    // ── Popup HTML factory ────────────────────────────────────────
    const isPetugas     = {{ auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']) ? 'true' : 'false' }};
    const currentUserId = {{ auth()->id() ?? 'null' }};

    window.confirmAntarkan = function(id, nama) {
        if (confirm(`Apakah Anda yakin mau mengantarkan daging untuk sohibul ${nama}?`)) {
            @this.call('antarkanSohibul', id);
        }
    };

    window.confirmSelesaikan = function(id, nama) {
        if (confirm(`Konfirmasi: daging untuk ${nama} sudah berhasil diantarkan?`)) {
            @this.call('selesaikanSohibul', id);
        }
    };

    window.confirmBatalkan = function(id, nama) {
        if (confirm(`Batalkan tugas pengantaran untuk ${nama}?\nStatus akan kembali ke Belum Terkirim.`)) {
            @this.call('batalkanSohibul', id);
        }
    };

    function makePopup(d) {
        const s       = STATUS[d.status] ?? STATUS[0];
        const nohpRaw = d.nohp ? d.nohp.toString().replace(/\D/g, '').replace(/^0/, '') : '';
        const waLink  = nohpRaw
            ? `<a href="https://wa.me/62${nohpRaw}" target="_blank" class="popup-link" style="color:#25D366">&#128241; WA: ${d.nohp}</a>`
            : '';
        const mapsLink = `<a href="${d.urlmap}" target="_blank" class="popup-link" style="color:#2563eb">&#128205; Google Maps</a>`;

        const antarkanBtn = (isPetugas && d.status === 0)
            ? `<button onclick="confirmAntarkan(${d.id}, '${d.nama.replace(/'/g, "\\'")}')" style="background:#22c55e; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; font-size:12px; font-weight:bold; width:100%; margin-top:10px; display:flex; justify-content:center; align-items:center; gap:6px;">&#128666; Antarkan Daging</button>`
            : '';

        // Tampilkan nama PJ hanya saat status Dalam Proses (1) atau Selesai (2)
        const selesaikanBtn = (isPetugas && d.status === 1 && d.pj_id === currentUserId)
            ? '<button onclick="confirmSelesaikan(' + d.id + ', \'' + d.nama.replace(/\'/g, "\\\'") + '\')" style="background:#2563eb;color:#fff;padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:12px;font-weight:bold;width:100%;margin-top:8px;display:flex;justify-content:center;align-items:center;gap:6px;">&#9989; Selesai Diantarkan</button>'
            : '';

        const batalkanBtn = (isPetugas && (d.status === 1 || d.status === 2) && d.pj_id === currentUserId)
            ? '<button onclick="confirmBatalkan(' + d.id + ', \'' + d.nama.replace(/\'/g, "\\\'") + '\')" style="background:#ef4444;color:#fff;padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:12px;font-weight:bold;width:100%;margin-top:8px;display:flex;justify-content:center;align-items:center;gap:6px;">&#8617; Batalkan Tugas</button>'
            : '';

        const pjRow = (d.status >= 1 && d.pj_nama)
            ? `<span class="popup-label">Petugas</span>
               <span style="font-weight:600;color:#1d4ed8">&#128100; ${d.pj_nama}</span>`
            : '';

        return `<div class="popup-inner">
            <div class="popup-header">
                <div class="popup-dot" style="background:${s.color}"></div>
                <div class="popup-name">${d.nama}</div>
            </div>
            <div class="popup-grid">
                <span class="popup-label">No.</span>
                <span><strong>${d.no}</strong></span>
                <span class="popup-label">Jenis</span>
                <span>${d.jenis}</span>
                <span class="popup-label">RT / RW</span>
                <span>RT ${d.rt} / RW ${d.rw ?? '-'}</span>
                <span class="popup-label">Alamat</span>
                <span>${d.alamat}</span>
                <span class="popup-label">Bagian</span>
                <span>${d.bagian}</span>
                <span class="popup-label">Status</span>
                <span class="popup-badge"
                      style="background:${s.badgeBg};color:${s.badgeText}">
                    ${d.statusLabel}
                </span>
                ${pjRow}
            </div>
            <div class="popup-footer">
                ${waLink}
                ${mapsLink}
            </div>
            ${antarkanBtn}${selesaikanBtn}${batalkanBtn}
        </div>`;
    }

    // ── Cluster configuration (pixel-based) ─────────────────
    // Dua marker dikumpulkan jika IKON-nya tumpang tindih di zoom maksimal.
    // Pendekatan ini lebih akurat dari jarak geografis tetap karena langsung
    // mengukur apakah dua ikon akan saling menutupi di layar.
    //
    // PIXEL_CLUSTER_THRESHOLD = 40px ≈ 1.25× lebar ikon marker (32px).
    // Contoh: R161, R328, R337 yang berjarak ~50m akan terdeteksi di zoom 20.
    const PIXEL_CLUSTER_THRESHOLD = 40;

    // Hitung jarak piksel antara dua marker pada zoom referensi
    function pixelDist(a, b, zoom) {
        const pa = map.project([a.lat, a.lng], zoom);
        const pb = map.project([b.lat, b.lng], zoom);
        return Math.sqrt(Math.pow(pa.x - pb.x, 2) + Math.pow(pa.y - pb.y, 2));
    }

    // Tentukan status dominan grup: prioritas belum (0) > proses (1) > selesai (2)
    function dominantStatus(items) {
        if (items.some(m => m.status === 0)) return 0;
        if (items.some(m => m.status === 1)) return 1;
        return 2;
    }

    // Kelompokkan RAW_MARKERS berdasarkan kedekatan piksel di zoom maksimal
    function buildGroups(markers) {
        const groups = [];
        const used   = new Set();
        markers.forEach((m, i) => {
            if (used.has(i)) return;
            const g = [m];
            used.add(i);
            markers.forEach((m2, j) => {
                if (j !== i && !used.has(j) && pixelDist(m, m2, MAP_MAX_ZOOM) < PIXEL_CLUSTER_THRESHOLD) {
                    g.push(m2);
                    used.add(j);
                }
            });
            groups.push(g);
        });
        return groups;
    }

    // ── Cluster icon factory ─────────────────────────────────
    function makeClusterIcon(count, statusCode) {
        const s = STATUS[statusCode] ?? STATUS[0];
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="42" height="54" viewBox="0 0 42 54">
            <path d="M21 0C12.72 0 6 6.72 6 15c0 11.25 15 39 15 39S36 26.25 36 15C36 6.72 29.28 0 21 0z"
                  fill="${s.color}" stroke="${s.border}" stroke-width="2"/>
            <circle cx="21" cy="15" r="11" fill="white" opacity="0.95"/>
            <text x="21" y="20" text-anchor="middle"
                  font-family="system-ui,sans-serif" font-size="12"
                  font-weight="bold" fill="${s.color}">${count}</text>
        </svg>`;
        return L.icon({
            iconUrl    : 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg),
            iconSize   : [42, 54],
            iconAnchor : [21, 54],
            popupAnchor: [0, -52],
        });
    }

    // ── Cluster carousel state & navigation ───────────────────
    let _clusterItems  = [];   // items yang sedang ditampilkan di carousel
    let _clusterIdx    = 0;    // index aktif
    let _clusterPopup  = null; // referensi L.Popup yang sedang terbuka

    // Helper: pasang L.DomEvent.disableClickPropagation pada content node popup
    // agar klik di dalam popup (termasuk tombol arrow) TIDAK merambat ke peta.
    // Harus dipanggil setiap kali setContent dijalankan karena Leaflet
    // mengganti innerHTML sehingga listener lama hilang.
    function stopPopupClickProp() {
        if (_clusterPopup && _clusterPopup._contentNode) {
            L.DomEvent.disableClickPropagation(_clusterPopup._contentNode);
        }
    }

    window.navigateCluster = function (dir) {
        _clusterIdx = (_clusterIdx + dir + _clusterItems.length) % _clusterItems.length;
        if (_clusterPopup) {
            _clusterPopup.setContent(makeClusterPopupHtml(_clusterItems, _clusterIdx));
            stopPopupClickProp();
        }
    };

    window.jumpCluster = function (idx) {
        _clusterIdx = idx;
        if (_clusterPopup) {
            _clusterPopup.setContent(makeClusterPopupHtml(_clusterItems, _clusterIdx));
            stopPopupClickProp();
        }
    };

    // HTML nav bar untuk cluster popup
    // Setiap onclick button juga memanggil event.stopPropagation() sebagai
    // lapisan pertahanan pertama sebelum L.DomEvent.disableClickPropagation.
    function makeClusterPopupHtml(items, idx) {
        const total = items.length;
        const dotsHtml = items.map((_, i) =>
            `<span class="cluster-nav-dot${i === idx ? ' active' : ''}"
                   onclick="event.stopPropagation();jumpCluster(${i})"
                   title="Sohibul ${i+1}"></span>`
        ).join('');
        const nav = `
            <div class="cluster-nav">
                <button class="cluster-nav-btn"
                        onclick="event.stopPropagation();navigateCluster(-1)"
                        title="Sebelumnya">&#8249;</button>
                <div class="cluster-nav-center">
                    <span class="cluster-nav-label">&#128205; ${idx + 1} dari ${total} sohibul</span>
                    <div class="cluster-nav-dots">${dotsHtml}</div>
                </div>
                <button class="cluster-nav-btn"
                        onclick="event.stopPropagation();navigateCluster(1)"
                        title="Berikutnya">&#8250;</button>
            </div>`;
        return nav + makePopup(items[idx]);
    }

    // ── Buat marker groups ────────────────────────────────────
    const rawGroups = buildGroups(RAW_MARKERS);

    // allGroups: [ { marker, items: [...], isCluster } ]
    const allGroups = rawGroups.map(items => {
        const isCluster = items.length > 1;

        // Posisi representatif: rata-rata centroid
        const lat = items.reduce((s, m) => s + m.lat, 0) / items.length;
        const lng = items.reduce((s, m) => s + m.lng, 0) / items.length;

        const icon  = isCluster
            ? makeClusterIcon(items.length, dominantStatus(items))
            : makeIcon(items[0].status);
        const title = isCluster
            ? `${items.length} sohibul di lokasi ini`
            : `[${items[0].no}] ${items[0].nama}`;

        const marker = L.marker([lat, lng], { icon, title, zIndexOffset: isCluster ? 100 : 0 })
            .addTo(map);

        if (isCluster) {
            marker.bindPopup('', { maxWidth: 320, minWidth: 260 });

            // Gunakan popupopen (bukan click) karena pada saat popupopen
            // popup sudah benar-benar ada di DOM sehingga:
            // (a) setContent langsung ter-render, dan
            // (b) disableClickPropagation bisa dipasang ke _contentNode.
            marker.on('popupopen', function () {
                _clusterItems = items;
                _clusterIdx   = 0;
                _clusterPopup = this.getPopup();
                _clusterPopup.setContent(makeClusterPopupHtml(items, 0));
                // Pasang proteksi: klik di dalam popup tidak merambat ke peta
                stopPopupClickProp();
            });

            // Reset state saat popup ditutup
            marker.on('popupclose', function () {
                _clusterPopup = null;
            });
        } else {
            marker.bindPopup(makePopup(items[0]), { maxWidth: 300, minWidth: 240 });
        }

        return { marker, items, isCluster };
    });

    // Flat list untuk iterasi per-item (digunakan badge & marker-updated)
    // Catatan: marker bisa dishare antar item di grup yang sama
    const allMarkers = allGroups.flatMap(g => g.items.map(d => ({ group: g, data: d })));

    // ── Auto fit bounds ──────────────────────────────────────
    if (allGroups.length > 0) {
        const group = L.featureGroup(allGroups.map(g => g.marker));
        map.fitBounds(group.getBounds().pad(0.15));
    }

    // PENTING: activeFilter harus dideklarasikan SEBELUM updateBadge() dipanggil.
    // Karena let tidak di-hoist (Temporal Dead Zone), jika updateBadge()
    // dipanggil sebelum baris ini, akan terjadi ReferenceError yang menghentikan
    // seluruh inisialisasi berikutnya — termasuk window.filterMarkers.
    let activeFilter = 'all';

    updateBadge();

    // ── Filter markers ────────────────────────────────────────

    window.filterMarkers = function (status) {
        activeFilter = status;

        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter-btn'));
        const activeBtn = document.getElementById('btn-' + status);
        if (activeBtn) activeBtn.classList.add('active-filter-btn');

        allGroups.forEach(g => {
            const visible = status === 'all'
                ? g.items
                : status === 'my'
                ? g.items.filter(d => d.pj_id === currentUserId)
                : g.items.filter(d => d.status === status);

            if (visible.length > 0) {
                if (!map.hasLayer(g.marker)) map.addLayer(g.marker);
                // Update ikon cluster agar mencerminkan jumlah & status terfilter
                if (g.isCluster) {
                    g.marker.setIcon(makeClusterIcon(visible.length, dominantStatus(visible)));
                    // Jika popup cluster ini sedang terbuka, perbarui isinya
                    if (_clusterPopup && g.marker.getPopup() === _clusterPopup) {
                        _clusterItems = visible;
                        _clusterIdx   = Math.min(_clusterIdx, visible.length - 1);
                        _clusterPopup.setContent(makeClusterPopupHtml(visible, _clusterIdx));
                    }
                }
            } else {
                if (map.hasLayer(g.marker)) map.removeLayer(g.marker);
            }
        });

        updateBadge();
    };

    function updateBadge() {
        let visible = 0;
        const total = allMarkers.length;
        allGroups.forEach(g => {
            if (map.hasLayer(g.marker)) {
                const vis = activeFilter === 'all'
                    ? g.items.length
                    : activeFilter === 'my'
                    ? g.items.filter(d => d.pj_id === currentUserId).length
                    : g.items.filter(d => d.status === activeFilter).length;
                visible += vis;
            }
        });
        const badge = document.getElementById('marker-count-badge');
        if (badge) badge.textContent = `&#128205; ${visible} dari ${total} sohibul ditampilkan`;
    }

    // ── Listen to Livewire Event for Marker Update ───────────────
    window.addEventListener('marker-updated', (event) => {
        const detail    = event.detail[0] || event.detail;
        const id        = detail.id;
        const newStatus = detail.status;
        // pj_id & pj_nama dikirim dari semua action (antarkan/selesaikan/batalkan)
        const newPjId   = Object.prototype.hasOwnProperty.call(detail, 'pj_id')   ? detail.pj_id   : undefined;
        const newPjNama = Object.prototype.hasOwnProperty.call(detail, 'pj_nama') ? detail.pj_nama : undefined;

        // Temukan grup yang mengandung item dengan id ini
        for (const g of allGroups) {
            const item = g.items.find(d => d.id === id);
            if (!item) continue;

            item.status      = newStatus;
            item.statusLabel = STATUS[newStatus]?.label ?? item.statusLabel;
            if (newPjId   !== undefined) item.pj_id   = newPjId;
            if (newPjNama !== undefined) item.pj_nama = newPjNama;

            // Logika visible berdasarkan activeFilter
            const visibleForFilter = (d) =>
                activeFilter === 'all'  ? true
                : activeFilter === 'my' ? d.pj_id === currentUserId
                : d.status === activeFilter;

            if (!g.isCluster) {
                // Marker tunggal: update ikon & popup langsung
                g.marker.setIcon(makeIcon(newStatus));
                g.marker.setPopupContent(makePopup(item));
                // Sembunyikan jika tidak sesuai filter aktif
                if (!visibleForFilter(item)) map.removeLayer(g.marker);
                else if (!map.hasLayer(g.marker)) map.addLayer(g.marker);
            } else {
                // Cluster: update ikon berdasarkan item yang terlihat saat ini
                const vis = g.items.filter(visibleForFilter);
                if (vis.length > 0) {
                    g.marker.setIcon(makeClusterIcon(vis.length, dominantStatus(vis)));
                    if (!map.hasLayer(g.marker)) map.addLayer(g.marker);
                } else {
                    map.removeLayer(g.marker);
                }
                // Jika popup cluster sedang terbuka, perbarui kontennya
                if (_clusterPopup && g.marker.getPopup() === _clusterPopup) {
                    _clusterItems = vis;
                    _clusterIdx   = Math.min(_clusterIdx, Math.max(0, vis.length - 1));
                    if (vis.length > 0) {
                        _clusterPopup.setContent(makeClusterPopupHtml(vis, _clusterIdx));
                        stopPopupClickProp();
                    } else {
                        g.marker.closePopup();
                    }
                }
            }

            updateBadge();
            break;
        }
    });

    // ── GPS Tracking for Petugas ──────────────────────────────────
    if (isPetugas && 'geolocation' in navigator) {
        let userMarker = null;
        let userCircle = null;

        // Custom icon for user location (pulsing blue dot)
        const userIcon = L.divIcon({
            className: 'user-gps-marker',
            html: `<div style="width:16px;height:16px;background:#3b82f6;border-radius:50%;border:3px solid #fff;box-shadow:0 0 10px rgba(59,130,246,0.8);animation: gpsPulse 1.5s infinite;"></div>`,
            iconSize: [16, 16],
            iconAnchor: [8, 8]
        });

        // Add CSS keyframes for pulse effect
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes gpsPulse {
                0% { box-shadow: 0 0 0 0 rgba(59,130,246, 0.7); }
                70% { box-shadow: 0 0 0 15px rgba(59,130,246, 0); }
                100% { box-shadow: 0 0 0 0 rgba(59,130,246, 0); }
            }
        `;
        document.head.appendChild(style);

        navigator.geolocation.watchPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                if (!userMarker) {
                    userMarker = L.marker([lat, lng], { icon: userIcon, zIndexOffset: 1000 }).addTo(map)
                        .bindPopup("<b>📍 Posisi Anda</b>", { autoClose: false });
                    userCircle = L.circle([lat, lng], {
                        radius: accuracy,
                        color: '#3b82f6',
                        fillColor: '#3b82f6',
                        fillOpacity: 0.15,
                        weight: 1
                    }).addTo(map);
                } else {
                    userMarker.setLatLng([lat, lng]);
                    userCircle.setLatLng([lat, lng]);
                    userCircle.setRadius(accuracy);
                }
            },
            (error) => {
                console.warn('Gagal mendapatkan lokasi GPS: ', error.message);
            },
            {
                enableHighAccuracy: true,
                maximumAge: 10000,
                timeout: 10000
            }
        );
    }

}); // end DOMContentLoaded
</script>
@endif

</x-filament-panels::page>
