<x-filament-panels::page>

@php
    $markers = $this->getMarkers();
    $stats   = $this->getStats();
    $apiKey  = $this->getApiKey();
    $markersJson = json_encode($markers, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
@endphp

{{-- ── Stats Bar ──────────────────────────────────────────────────── --}}
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
        <span class="text-lg mb-1">⬜</span>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Belum Diproses</p>
        <p class="text-2xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['belum'] }}</p>
    </div>
    <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800 p-4 flex flex-col items-center">
        <span class="text-lg mb-1">🟡</span>
        <p class="text-xs text-amber-600 dark:text-amber-400 mb-1">Sedang Diproses</p>
        <p class="text-2xl font-bold text-amber-700 dark:text-amber-300">{{ $stats['proses'] }}</p>
    </div>
    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800 p-4 flex flex-col items-center">
        <span class="text-lg mb-1">🟢</span>
        <p class="text-xs text-green-600 dark:text-green-400 mb-1">Selesai</p>
        <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $stats['selesai'] }}</p>
    </div>
</div>

{{-- ── Legend & Filter Controls ────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
    {{-- Legend --}}
    <div class="flex flex-wrap items-center gap-4 text-sm">
        <span class="font-semibold text-gray-600 dark:text-gray-300">Keterangan:</span>
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

    {{-- Filter Buttons --}}
    <div class="flex items-center gap-2" id="filter-controls">
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
    </div>
</div>

{{-- ── Map Container ───────────────────────────────────────────────── --}}
<div wire:ignore class="relative rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg" style="height:600px;">

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

<p class="text-xs text-gray-400 dark:text-gray-500 mt-2 text-center sm:text-left">
    Hanya sohibul dengan URL Google Maps yang ditampilkan ({{ count($markers) }} dari {{ $stats['total'] }}).
</p>

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

    const map = L.map('sohibul-map', {
        center     : defaultCenter,
        zoom       : 14,
        zoomControl: true,
        attributionControl: false // Sembunyikan tulisan Leaflet, geoapify, openstreet, dan bendera
    });

    // Pasang tile layer default
    L.tileLayer(`https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=${GEOAPIFY_KEY}`, {
        maxZoom: 20,
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
    const isPetugas = {{ auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']) ? 'true' : 'false' }};

    window.confirmAntarkan = function(id, nama) {
        if (confirm(`Apakah Anda yakin mau mengantarkan daging untuk sohibul ${nama}?`)) {
            @this.call('antarkanSohibul', id);
        }
    };

    function makePopup(d) {
        const s    = STATUS[d.status] ?? STATUS[0];
        const nohpRaw = d.nohp ? d.nohp.toString().replace(/\D/g, '').replace(/^0/, '') : '';
        const waLink  = nohpRaw
            ? `<a href="https://wa.me/62${nohpRaw}" target="_blank" class="popup-link" style="color:#25D366">📱 WA: ${d.nohp}</a>`
            : '';
        const mapsLink = `<a href="${d.urlmap}" target="_blank" class="popup-link" style="color:#2563eb">📍 Google Maps</a>`;

        const antarkanBtn = (isPetugas && d.status === 0) 
            ? `<button onclick="confirmAntarkan(${d.id}, '${d.nama.replace(/'/g, "\\'")}')" style="background:#22c55e; color:#fff; padding:6px 12px; border-radius:6px; border:none; cursor:pointer; font-size:12px; font-weight:bold; width:100%; margin-top:10px; display:flex; justify-content:center; align-items:center; gap:6px;">🚚 Antarkan Daging</button>`
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
            </div>
            <div class="popup-footer">
                ${waLink}
                ${mapsLink}
            </div>
            ${antarkanBtn}
        </div>`;
    }

    // ── Buat markers ──────────────────────────────────────────────
    const allMarkers = RAW_MARKERS.map(d => {
        const marker = L.marker([d.lat, d.lng], { icon: makeIcon(d.status), title: `[${d.no}] ${d.nama}` })
            .addTo(map)
            .bindPopup(makePopup(d), { maxWidth: 300, minWidth: 240 });
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

        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter-btn'));
        const activeBtn = document.getElementById('btn-' + status);
        if (activeBtn) activeBtn.classList.add('active-filter-btn');

        // Show/hide markers
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
        if (badge) badge.textContent = `📍 ${visible} dari ${allMarkers.length} sohibul ditampilkan`;
    }

    // ── Listen to Livewire Event for Marker Update ────────────────
    window.addEventListener('marker-updated', (event) => {
        const detail = event.detail[0] || event.detail; // Handle different Livewire versions
        const id = detail.id;
        const newStatus = detail.status;
        
        const item = allMarkers.find(m => m.data.id === id);
        if (item) {
            item.data.status = newStatus;
            item.data.statusLabel = STATUS[newStatus].label;
            
            // Update the map marker icon
            item.marker.setIcon(makeIcon(newStatus));
            // Update the popup content
            item.marker.setPopupContent(makePopup(item.data));
            
            // Reapply filter so if we are viewing "Belum Diproses", it disappears
            if (activeFilter !== 'all') {
                filterMarkers(activeFilter);
            }
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
