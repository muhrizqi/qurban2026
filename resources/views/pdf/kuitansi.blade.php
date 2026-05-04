<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kuitansi Qurban - {{ $sohibul->no_sohibul }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #1a202c; line-height: 1.4; margin: 0; padding: 30px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #2d3748; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; color: #2d3748; text-transform: uppercase; letter-spacing: 2px; }
        .header p { margin: 5px 0; font-size: 12px; color: #718096; }
        
        .title-section { text-align: center; margin-bottom: 40px; }
        .title-section h2 { margin: 0; font-size: 20px; text-decoration: underline; }
        .title-section p { margin: 5px 0; font-weight: bold; font-family: 'Courier', monospace; font-size: 16px; }

        .content { margin-bottom: 50px; }
        .row { display: flex; margin-bottom: 15px; }
        .label { width: 180px; font-weight: bold; color: #4a5568; }
        .value { border-bottom: 1px dotted #cbd5e0; flex-grow: 1; padding-bottom: 2px; }
        
        .amount-box { 
            background: #f7fafc; 
            border: 2px solid #2d3748; 
            padding: 15px; 
            display: inline-block; 
            font-size: 20px; 
            font-weight: 900; 
            margin-top: 20px;
        }

        .footer { margin-top: 60px; }
        .signature-table { width: 100%; }
        .signature-table td { width: 50%; text-align: center; }
        .signature-space { height: 80px; }
        .stamp { color: #e53e3e; font-weight: bold; border: 3px double #e53e3e; padding: 5px; display: inline-block; transform: rotate(-5deg); margin-top: 10px; opacity: 0.6; }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0,0,0,0.03);
            white-space: nowrap;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="watermark">QURBAN 2026</div>

    <div class="header">
        <h1>PANITIA QURBAN MASJID JOGOKARIYAN</h1>
        <p>Jl. Jogokariyan No.36, Mantrijeron, Kec. Mantrijeron, Kota Yogyakarta, DIY 55143</p>
    </div>

    <div class="title-section">
        <h2>KUITANSI QURBAN</h2>
        <p>No: {{ $sohibul->no_sohibul }}</p>
    </div>

    <div class="content">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td class="label" style="padding: 10px 0;">Telah terima dari</td>
                <td style="padding: 10px 0;">:</td>
                <td class="value" style="padding: 10px 0;"><strong>{{ strtoupper($sohibul->nama) }}</strong></td>
            </tr>
            <tr>
                <td class="label" style="padding: 10px 0;">Alamat / No. HP</td>
                <td style="padding: 10px 0;">:</td>
                <td class="value" style="padding: 10px 0;">{{ $sohibul->alamat }} / {{ $sohibul->nohp }}</td>
            </tr>
            <tr>
                <td class="label" style="padding: 10px 0;">Uang Sejumlah</td>
                <td style="padding: 10px 0;">:</td>
                <td class="value" style="padding: 10px 0;"><i>{{ ucwords(\App\Helpers\Terbilang::make($sohibul->nilaisepertuju)) }} Rupiah</i></td>
            </tr>
            <tr>
                <td class="label" style="padding: 10px 0;">Untuk Pembayaran</td>
                <td style="padding: 10px 0;">:</td>
                <td class="value" style="padding: 10px 0;">Infaq Qurban Sapi Paket <strong>{{ $sohibul->jenis }}</strong> ({{ $sohibul->keterangan ?? '-' }})</td>
            </tr>
        </table>

        <div class="amount-box">
            Rp {{ number_format($sohibul->nilaisepertuju, 0, ',', '.') }},-
        </div>
    </div>

    <div class="footer">
        <table class="signature-table">
            <tr>
                <td>
                    <p>Sohibul,</p>
                    <div class="signature-space"></div>
                    <p>( ................................ )</p>
                </td>
                <td>
                    <p>Yogyakarta, {{ now()->translatedFormat('d F Y') }}</p>
                    <p>Bendahara Qurban,</p>
                    <div class="signature-space">
                        <div class="stamp">LUNAS - REK QURBAN</div>
                    </div>
                    <p><strong>( Panitia Masjid Jogokariyan )</strong></p>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 50px; font-size: 10px; color: #a0aec0; border-top: 1px solid #edf2f7; padding-top: 10px; text-align: center;">
        Dicetak secara sistem pada {{ now()->format('d/m/Y H:i') }} | ID: {{ $sohibul->id }}
    </div>
</body>
</html>
