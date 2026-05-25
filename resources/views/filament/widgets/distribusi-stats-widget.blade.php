@php
    $items = [
        ['emoji' => '✅', 'label' => 'Diantar',    'value' => $sudahDiantar,   'bg' => '#dcfce7', 'color' => '#166534'],
        ['emoji' => '🚚', 'label' => 'Proses',     'value' => $sedangDiantar,  'bg' => '#fef9c3', 'color' => '#854d0e'],
        ['emoji' => '🏠', 'label' => 'Ambil Sdri', 'value' => $diambilSendiri, 'bg' => '#dbeafe', 'color' => '#1e3a8a'],
        ['emoji' => '🚫', 'label' => 'Tdk Ambil',  'value' => $tidakDiambil,   'bg' => '#f3f4f6', 'color' => '#374151'],
        ['emoji' => '⏳', 'label' => 'Belum',       'value' => $belumDiproses,  'bg' => '#fee2e2', 'color' => '#991b1b'],
        ['emoji' => '📦', 'label' => 'Total',       'value' => $total,          'bg' => '#ede9fe', 'color' => '#4c1d95'],
    ];
@endphp

<div style="
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    padding: 8px 12px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    margin-bottom: 4px;
">
    @foreach ($items as $item)
        <span style="
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: {{ $item['bg'] }};
            color: {{ $item['color'] }};
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            line-height: 1.4;
        ">
            {{ $item['emoji'] }}
            <strong>{{ $item['value'] }}</strong>
            <span style="font-weight:400;opacity:0.85;">{{ $item['label'] }}</span>
        </span>
    @endforeach
</div>
