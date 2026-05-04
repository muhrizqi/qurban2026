<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Sohibul Qurban 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg); 
            color: var(--text-main); 
            margin: 0; 
            padding: 0;
            line-height: 1.5;
        }
        .container { 
            max-width: 800px; 
            margin: 40px auto; 
            padding: 0 20px; 
        }
        header { 
            text-align: center; 
            margin-bottom: 40px; 
        }
        header h1 { 
            font-size: 32px; 
            font-weight: 800; 
            color: var(--primary-dark);
            margin: 0 0 10px 0;
            letter-spacing: -0.02em;
        }
        header p { 
            color: var(--text-muted); 
            margin: 0;
            font-size: 16px;
        }

        .category-section {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .category-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 15px 25px;
            font-weight: 700;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .category-header span {
            background: rgba(255,255,255,0.2);
            padding: 2px 10px;
            border-radius: 99px;
            font-size: 14px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th { 
            text-align: left; 
            background: #f1f5f9; 
            padding: 12px 25px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid #e2e8f0;
        }
        td { 
            padding: 14px 25px; 
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }

        .no-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: 700;
            font-size: 14px;
            border: 1px solid #e2e8f0;
        }
        .nama-text {
            font-weight: 600;
            color: #1e293b;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            padding-bottom: 40px;
            color: var(--text-muted);
            font-size: 14px;
        }

        @media (max-width: 640px) {
            .container { margin: 20px auto; }
            header h1 { font-size: 26px; }
            td, th { padding: 12px 15px; }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>SOHIBUL QURBAN 2026</h1>
            <p>Daftar Peserta Qurban Masjid Jogokariyan</p>
        </header>

        @php
            $jenisList = ['REGULER', 'SUPER', 'DUPER', 'PRIBADI'];
        @endphp

        @foreach($jenisList as $jenis)
            @php
                $items = \App\Models\SohibulSapi::where('jenis', $jenis)->get()->sortBy(function($item) {
                    return (int) preg_replace('/[^0-9]/', '', $item->no_sohibul);
                });
            @endphp

            @if($items->count() > 0)
                <div class="category-section">
                    <div class="category-header">
                        {{ $jenis }}
                        <span>{{ $items->count() }} Orang</span>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 140px;">No. Sohibul</th>
                                <th>Nama Sohibul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td><span class="no-badge">{{ $item->no_sohibul }}</span></td>
                                    <td class="nama-text">{{ strtoupper($item->nama) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach

        <div class="footer">
            &copy; {{ date('Y') }} Masjid Jogokariyan Yogyakarta<br>
            Data diperbarui secara otomatis dari sistem.
        </div>
    </div>

</body>
</html>
