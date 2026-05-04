<x-filament-panels::page>

    @php
        $unimported    = $this->getUnimportedRecords();
        $importedList  = $this->getImportedSohibulList();
        $totalFiltered = count($unimported);

        $confirmed    = count(array_filter($records, fn($r) => strtolower($r['status'] ?? '') === 'confirmed'));
        $pending      = count(array_filter($records, fn($r) => strtolower($r['status'] ?? '') === 'pending'));
        $totalNominal = array_sum(array_column($records, 'harga'));
        $paketCounts  = [];
        foreach ($records as $r) {
            $p = $r['paket'] ?? 'Lainnya';
            $paketCounts[$p] = ($paketCounts[$p] ?? 0) + 1;
        }
    @endphp

    <style>
        .qurban-table { width:100%; border-collapse:collapse; font-size:13px; }
        .qurban-table th, .qurban-table td { border:1px solid #e5e7eb; padding:8px 11px; text-align:left; vertical-align:middle; }
        .qurban-table thead th { background:#f9fafb; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:#6b7280; white-space:nowrap; }
        .qurban-table tbody tr:nth-child(even) { background:#f9fafb; }
        .qurban-table tbody tr:hover { background:#eff6ff !important; }
        .qurban-table tfoot td { background:#f3f4f6; font-weight:700; font-size:12px; }
        .q-badge { display:inline-flex; align-items:center; padding:3px 9px; border-radius:9999px; font-size:11px; font-weight:700; white-space:nowrap; border:1px solid transparent; }
        .q-stat { border-radius:16px; padding:16px 18px; position:relative; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        .q-stat-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; margin-bottom:5px; opacity:.85; }
        .q-stat-value { font-size:30px; font-weight:900; line-height:1; }
        .q-stat-sub { font-size:11px; margin-top:4px; opacity:.7; }
        .inv-no { font-family:'Courier New',monospace; font-size:11px; font-weight:700; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:5px; padding:2px 6px; color:#334155; }
        .wa-link { display:inline-flex; align-items:center; gap:4px; color:#16a34a; font-size:12px; font-weight:500; text-decoration:none; white-space:nowrap; }
        .wa-link:hover { text-decoration:underline; }
        .bukti-btn { display:inline-flex; align-items:center; gap:4px; background:#2563eb; color:#fff; font-size:11px; font-weight:700; padding:3px 8px; border-radius:6px; text-decoration:none; }
        .bukti-btn:hover { background:#1d4ed8; }
        .import-btn { display:inline-flex; align-items:center; gap:4px; background:#059669; color:#fff; font-size:11px; font-weight:700; padding:4px 10px; border-radius:7px; border:none; cursor:pointer; white-space:nowrap; }
        .import-btn:hover { background:#047857; }
        .view-btn { display:inline-flex; align-items:center; gap:4px; background:#6366f1; color:#fff; font-size:11px; font-weight:700; padding:4px 10px; border-radius:7px; text-decoration:none; white-space:nowrap; }
        .view-btn:hover { background:#4f46e5; }
        .q-search { width:100%; max-width:360px; border:1px solid #d1d5db; border-radius:10px; padding:8px 14px 8px 36px; font-size:13px; outline:none; background:#fff; color:#111827; box-shadow:0 1px 3px rgba(0,0,0,.06); }
        .q-search:focus { border-color:#f59e0b; box-shadow:0 0 0 3px rgba(245,158,11,.15); }
        .section-header { display:flex; align-items:center; justify-content:space-between; background:linear-gradient(90deg,#f8fafc,#f1f5f9); border:1px solid #e2e8f0; border-bottom:none; border-radius:12px 12px 0 0; padding:11px 15px; }
        .section-header-green { background:linear-gradient(90deg,#f0fdf4,#dcfce7); border-color:#bbf7d0; }
        .section-wrap { border:1px solid #e2e8f0; border-radius:0 0 12px 12px; box-shadow:0 2px 8px rgba(0,0,0,.06); overflow-x:auto; margin-bottom:28px; }
        .section-wrap-green { border-color:#bbf7d0; }
    </style>

    {{-- Error --}}
    @if ($error)
        <div style="border:1px solid #fca5a5;background:#fef2f2;border-radius:12px;padding:16px;display:flex;gap:12px;margin-bottom:20px;">
            <div style="color:#ef4444;flex-shrink:0;">⚠️</div>
            <div>
                <p style="font-weight:700;color:#b91c1c;font-size:14px;margin-bottom:4px">Gagal mengambil data dari API</p>
                <p style="font-family:monospace;color:#dc2626;font-size:12px;word-break:break-all">{{ $error }}</p>
            </div>
        </div>
    @endif

    {{-- Stats --}}
    @if (!empty($records))
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin-bottom:18px;">
        <div class="q-stat" style="background:linear-gradient(135deg,#1e293b,#0f172a);color:#fff;">
            <div class="q-stat-label">Total Invoice API</div>
            <div class="q-stat-value">{{ number_format($totalAll) }}</div>
            <div class="q-stat-sub">Belum import: {{ count($unimported) }} · Sudah: {{ count($importedList) }}</div>
        </div>
        <div class="q-stat" style="background:linear-gradient(135deg,#059669,#047857);color:#fff;">
            <div class="q-stat-label">✅ Confirmed</div>
            <div class="q-stat-value">{{ number_format($confirmed) }}</div>
            <div class="q-stat-sub">{{ $totalAll > 0 ? round($confirmed/$totalAll*100) : 0 }}% dari total</div>
        </div>
        <div class="q-stat" style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;">
            <div class="q-stat-label">⏳ Pending</div>
            <div class="q-stat-value">{{ number_format($pending) }}</div>
        </div>
        <div class="q-stat" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;">
            <div class="q-stat-label">💰 Total Nilai</div>
            <div class="q-stat-value" style="font-size:18px;">Rp&nbsp;{{ number_format($totalNominal,0,',','.') }}</div>
        </div>
    </div>

    {{-- Paket breakdown --}}
    @if (!empty($paketCounts))
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin-bottom:14px;">
        <span style="font-size:12px;color:#6b7280;font-weight:600;">Paket:</span>
        @foreach ($paketCounts as $paket => $jumlah)
            <span style="display:inline-flex;align-items:center;gap:6px;padding:3px 10px;border-radius:9999px;font-size:12px;font-weight:700;border:1px solid #c7d2fe;background:#eef2ff;color:#4338ca;">
                {{ $paket }}<span style="background:#4338ca;color:#fff;border-radius:9999px;padding:1px 6px;font-size:10px;">{{ $jumlah }}</span>
            </span>
        @endforeach
    </div>
    @endif
    @endif

    {{-- Search --}}
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px;flex-wrap:wrap;">
        <div style="position:relative;flex:1;max-width:360px;">
            <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);width:15px;height:15px;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input wire:model.live="search" type="text" placeholder="Cari nama, invoice, HP..." class="q-search"/>
        </div>
        @if ($lastFetch)
            <span style="font-size:11px;color:#9ca3af;">🕐 {{ $lastFetch }} · Cache 5 menit</span>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- TABEL 1 — Belum Diimport                                       --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <div class="section-header">
        <span style="font-weight:700;font-size:14px;color:#334155;">📋 Belum Dimasukkan ke Sohibul Sapi</span>
        <span style="background:#fef3c7;color:#92400e;font-size:11px;font-weight:700;padding:3px 10px;border-radius:9999px;border:1px solid #fcd34d;">{{ $totalFiltered }} record</span>
    </div>
    <div class="section-wrap">
        <table class="qurban-table">
            <thead>
                <tr>
                    <th style="width:36px;text-align:center;">#</th>
                    <th>No. Invoice</th>
                    <th>Nama Sohibul</th>
                    <th>Paket</th>
                    <th style="text-align:right;">Harga</th>
                    <th>Tanggal</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($unimported as $i => $row)
                    <tr>
                        <td style="text-align:center;color:#9ca3af;font-size:11px;">{{ $i + 1 }}</td>

                        {{-- Invoice + bukti --}}
                        <td>
                            <a href="https://sedekah.masjidjogokariyan.com/invoices/{{ $row['noinvoice'] }}/download-receipt"
                               target="_blank" style="text-decoration:none;">
                                <span class="inv-no">{{ $row['noinvoice'] }}</span>
                            </a>
                            @if ($row['bukti'])
                                <br><a href="{{ $row['bukti'] }}" target="_blank" class="bukti-btn" style="margin-top:4px;display:inline-flex;">
                                    🖼 Bukti
                                </a>
                            @endif
                        </td>

                        {{-- Nama + HP --}}
                        <td>
                            <div style="font-weight:600;color:#111827;">{{ $row['nama'] }}</div>
                            @if (!empty($row['hp']) && $row['hp'] !== '-')
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $row['hp']) }}"
                                   target="_blank" class="wa-link" style="margin-top:2px;">
                                    <svg style="width:12px;height:12px;" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    {{ $row['hp'] }}
                                </a>
                            @endif
                        </td>

                        {{-- Paket --}}
                        <td>
                            @php
                                $pn = strtolower($row['paket'] ?? '');
                                [$bg,$tc,$bc] = match(true) {
                                    str_contains($pn,'super duper')||str_contains($pn,'duper') => ['#d1fae5','#065f46','#6ee7b7'],
                                    str_contains($pn,'reguler')  => ['#dbeafe','#1d4ed8','#93c5fd'],
                                    str_contains($pn,'super')    => ['#f3e8ff','#7c3aed','#c4b5fd'],
                                    str_contains($pn,'pribadi')  => ['#ffe4e6','#be123c','#fca5a5'],
                                    default                      => ['#f3f4f6','#374151','#d1d5db'],
                                };
                            @endphp
                            <span class="q-badge" style="background:{{$bg}};color:{{$tc}};border-color:{{$bc}};">{{ $row['paket'] }}</span>
                        </td>

                        {{-- Harga --}}
                        <td style="text-align:right;white-space:nowrap;font-weight:700;color:#111827;font-size:12px;">
                            @if ((float)($row['harga'] ?? 0) > 0)
                                Rp&nbsp;{{ number_format((float)$row['harga'],0,',','.') }}
                            @else —
                            @endif
                        </td>

                        {{-- Tanggal --}}
                        <td style="white-space:nowrap;font-size:12px;color:#374151;">
                            @if ($row['tanggal'])
                                {{ \Carbon\Carbon::parse($row['tanggal'])->timezone('Asia/Jakarta')->isoFormat('D MMM YY') }}
                            @else —
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td style="text-align:center;white-space:nowrap;">
                            <button wire:click="prepareImport('{{ $row['noinvoice'] }}')"
                                    class="import-btn">
                                ➕ Import
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:#9ca3af;">
                            @if ($search)
                                Tidak ada hasil untuk "{{ $search }}"
                            @else
                                ✅ Semua data sudah diimport ke Sohibul Sapi!
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if ($totalFiltered > 0)
            <tfoot>
                <tr>
                    <td colspan="4" style="font-size:12px;color:#6b7280;">
                        Menampilkan <strong>{{ $totalFiltered }}</strong> record belum diimport
                    </td>
                    <td style="text-align:right;color:#111827;font-size:13px;font-weight:800;">
                        Rp&nbsp;{{ number_format(array_sum(array_column($unimported,'harga')),0,',','.') }}
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════ --}}
    {{-- TABEL 2 — Sudah Diimport                                       --}}
    {{-- ═══════════════════════════════════════════════════════════════ --}}
    <div class="section-header section-header-green">
        <span style="font-weight:700;font-size:14px;color:#065f46;">✅ Sudah Masuk ke Sohibul Sapi</span>
        <span style="background:#d1fae5;color:#065f46;font-size:11px;font-weight:700;padding:3px 10px;border-radius:9999px;border:1px solid #6ee7b7;">{{ count($importedList) }} record</span>
    </div>
    <div class="section-wrap section-wrap-green">
        <table class="qurban-table">
            <thead>
                <tr style="background:#f0fdf4;">
                    <th style="width:36px;text-align:center;">#</th>
                    <th>No. Sohibul</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>No. Invoice</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($importedList as $i => $sob)
                    @php $sob = (array)$sob; @endphp
                    <tr>
                        <td style="text-align:center;color:#9ca3af;font-size:11px;">{{ $i + 1 }}</td>

                        <td style="font-family:monospace;font-weight:700;color:#1d4ed8;font-size:12px;">
                            {{ $sob['no_sohibul'] }}
                        </td>

                        <td style="font-weight:600;color:#111827;">{{ $sob['nama'] }}</td>

                        <td>
                            @php
                                $j = $sob['jenis'] ?? '';
                                [$bg,$tc,$bc] = match($j) {
                                    'DUPER'   => ['#d1fae5','#065f46','#6ee7b7'],
                                    'REGULER' => ['#dbeafe','#1d4ed8','#93c5fd'],
                                    'SUPER'   => ['#f3e8ff','#7c3aed','#c4b5fd'],
                                    'PRIBADI' => ['#ffe4e6','#be123c','#fca5a5'],
                                    default   => ['#f3f4f6','#374151','#d1d5db'],
                                };
                            @endphp
                            <span class="q-badge" style="background:{{$bg}};color:{{$tc}};border-color:{{$bc}};">{{ $j }}</span>
                        </td>

                        <td>
                            <a href="https://sedekah.masjidjogokariyan.com/invoices/{{ $sob['noinvoice'] }}/download-receipt"
                               target="_blank" style="text-decoration:none;">
                                <span class="inv-no">{{ $sob['noinvoice'] }}</span>
                            </a>
                        </td>

                        <td style="text-align:center;">
                            <a href="{{ route('filament.admin.resources.sohibul-sapi.view', $sob['id']) }}"
                               class="view-btn">
                                🔍 Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:32px;color:#9ca3af;">
                            Belum ada data yang diimport dari API
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (!$error && empty($records))
        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:80px 0;color:#9ca3af;text-align:center;">
            <p style="font-weight:700;font-size:15px;color:#6b7280;">Tidak ada data</p>
            <p style="font-size:12px;margin-top:4px;">Klik <strong>Refresh Data</strong> untuk mengambil data dari API</p>
        </div>
    @endif

</x-filament-panels::page>
