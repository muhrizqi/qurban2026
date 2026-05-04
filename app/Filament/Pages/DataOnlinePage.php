<?php

namespace App\Filament\Pages;

use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DataOnlinePage extends Page
{
    public array   $records            = [];
    public array   $existingNoinvoices = [];   // noinvoice yg sudah ada di sohibul_sapi
    public array   $pendingImport      = [];   // data record yg sedang disiapkan import
    public ?string $error              = null;
    public ?string $lastFetch          = null;
    public string  $search             = '';
    public int     $totalAll           = 0;

    public static function getNavigationLabel(): string { return '🌐 Data Online'; }
    public static function getNavigationIcon(): string  { return 'heroicon-o-globe-alt'; }
    public static function getNavigationSort(): ?int    { return 100; }
    public function getView(): string                   { return 'filament.pages.data-online'; }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminsohibul']);
    }

    public function mount(): void
    {
        $this->loadData();
    }

    // ── Helpers statis ───────────────────────────────────────────

    private static function rtOptions(): array
    {
        $opts = ['non_warga' => 'Non Warga (Luar Jogokariyan)'];
        foreach (range(30, 47) as $rt) {
            $opts[(string)$rt] = 'RT ' . $rt;
        }
        return $opts;
    }

    private static function detectJenis(string $paket): string
    {
        $p = strtolower($paket);
        if (str_contains($p, 'super duper') || str_contains($p, 'duper')) return 'DUPER';
        if (str_contains($p, 'reguler') || str_contains($p, 'regular'))   return 'REGULER';
        if (str_contains($p, 'super'))                                     return 'SUPER';
        if (str_contains($p, 'pribadi'))                                   return 'PRIBADI';
        return 'REGULER';
    }

    /**
     * Mapping add_ons name → [bagiansohibul, rt]
     */
    private static function detectBagianRt(string $addOnsName): array
    {
        return match($addOnsName) {
            'Jatah Tidak Diambil'        => ['bagiansohibul' => 'tidak_diambil',  'rt' => null],
            'Warga Jogokariyan'          => ['bagiansohibul' => 'diantarkan',     'rt' => null],
            'Diambil Sendiri'            => ['bagiansohibul' => 'diambil_sendiri','rt' => null],
            'Diantar (Luar Jogokariyan)' => ['bagiansohibul' => 'diantarkan',     'rt' => 'non_warga'],
            default                      => ['bagiansohibul' => null,             'rt' => null],
        };
    }

    // ── Load data ────────────────────────────────────────────────

    protected function loadData(): void
    {
        try {
            $cached = Cache::remember('qurban_api_data', 300, function () {
                $response = Http::withHeaders(['X-API-KEY' => env('QURBAN_API_TOKEN')])
                    ->timeout(15)
                    ->get(env('QURBAN_API_URL'));

                if ($response->successful()) {
                    $body      = $response->json();
                    $paginator = $body['data'] ?? null;

                    if (is_array($paginator) && isset($paginator['data'])) {
                        $rows  = $paginator['data'];
                        $total = $paginator['total'] ?? count($rows);
                    } elseif (is_array($paginator) && is_list($paginator)) {
                        $rows  = $paginator;
                        $total = count($rows);
                    } elseif (isset($body['invoices'])) {
                        $rows  = $body['invoices'];
                        $total = count($rows);
                    } else {
                        $rows = []; $total = 0;
                    }

                    $flat = array_map(function ($row) {
                        $sohibul = $row['sohibul'] ?? [];
                        $package = $row['package'] ?? [];
                        $addOns  = $row['add_ons'] ?? [];
                        return [
                            'noinvoice'     => $row['invoice_number'] ?? '-',
                            'nama'          => $sohibul['name']    ?? '-',
                            'hp'            => $sohibul['phone']   ?? '-',
                            'email'         => $sohibul['email']   ?? '-',
                            'alamat'        => $sohibul['address'] ?? '-',
                            'catatan'       => $sohibul['note']    ?? '-',
                            'paket'         => $package['name']    ?? '-',
                            'harga'         => $package['price']   ?? 0,
                            'status'        => $row['status']      ?? '-',
                            'bukti'         => $row['proof_image'] ?? null,
                            'tanggal'       => $row['created_at']  ?? null,
                            'bagiansohibul' => $addOns['name']     ?? '',
                        ];
                    }, $rows);

                    return ['rows' => $flat, 'total' => $total];
                }

                throw new \Exception('API error: HTTP ' . $response->status() . ' — ' . substr($response->body(), 0, 300));
            });

            $this->records   = $cached['rows']  ?? [];
            $this->totalAll  = $cached['total'] ?? count($this->records);
            $this->error     = null;
            $this->lastFetch = now()->format('d M Y H:i:s');

        } catch (\Exception $e) {
            $this->error    = $e->getMessage();
            $this->records  = [];
            $this->totalAll = 0;
        }

        // load daftar noinvoice yang sudah tersimpan
        $this->existingNoinvoices = SohibulSapi::whereNotNull('noinvoice')
            ->pluck('noinvoice')
            ->toArray();
    }

    // ── Derived record lists ──────────────────────────────────────

    public function getUnimportedRecords(): array
    {
        $existing = $this->existingNoinvoices;
        $keyword  = strtolower($this->search);

        $rows = array_values(array_filter(
            $this->records,
            fn($r) => !in_array($r['noinvoice'], $existing, true)
        ));

        if ($keyword === '') return $rows;

        return array_values(array_filter($rows, function ($r) use ($keyword) {
            foreach ($r as $v) {
                if (str_contains(strtolower((string)$v), $keyword)) return true;
            }
            return false;
        }));
    }

    /** Kembalikan data sohibul_sapi untuk noinvoice yang sudah diimport */
    public function getImportedSohibulList(): array
    {
        if (empty($this->existingNoinvoices)) return [];

        return SohibulSapi::whereIn('noinvoice', $this->existingNoinvoices)
            ->orderBy('no_sohibul')
            ->get(['id', 'no_sohibul', 'nama', 'jenis', 'noinvoice'])
            ->toArray();
    }

    // ── Import action ─────────────────────────────────────────────

    /** Dipanggil dari blade saat tombol "Import" diklik */
    public function prepareImport(string $noinvoice): void
    {
        foreach ($this->records as $rec) {
            if ($rec['noinvoice'] === $noinvoice) {
                $this->pendingImport = $rec;
                break;
            }
        }
        $this->mountAction('import');
    }

    public function importAction(): Action
    {
        return Action::make('import')
            ->label('Import ke Sohibul Sapi')
            ->modalHeading('Import Data Invoice ke Sohibul Sapi')
            ->modalSubmitActionLabel('💾 Simpan ke Sohibul Sapi')
            ->modalWidth('2xl')
            ->fillForm(function (): array {
                $d      = $this->pendingImport;
                $jenis  = self::detectJenis($d['paket'] ?? '');
                $nilai  = SohibulSapi::NILAI_DEFAULT[$jenis] ?? null;
                $noSob  = SohibulSapi::nextNoSohibul($jenis);
                $bagRt  = self::detectBagianRt($d['bagiansohibul'] ?? '');
                $rt     = $bagRt['rt'];
                $rw     = $rt === 'non_warga' ? null : (isset(SohibulSapi::RT_RW_MAP[$rt]) ? SohibulSapi::RT_RW_MAP[$rt] : null);

                return [
                    'noinvoice'      => $d['noinvoice']  ?? '',
                    'jenis'          => $jenis,
                    'no_sohibul'     => $noSob,
                    'nama'           => $d['nama']        ?? '',
                    'nama_kk'        => $d['nama']        ?? '',
                    'nohp'           => $d['hp']          ?? '',
                    'alamat'         => $d['alamat']      ?? '',
                    'rt'             => $rt,
                    'rw'             => $rw,
                    'bagiansohibul'  => $bagRt['bagiansohibul'],
                    'nilaisepertuju' => $nilai,
                    'posisidana'     => 'Rek Program',
                    'kwitansi'       => 'https://sedekah.masjidjogokariyan.com/invoices/' . ($d['noinvoice'] ?? '') . '/download-receipt',
                    'urlmap'         => '',
                    'keterangan'     => $d['catatan'] ?? '',
                ];
            })
            ->form([
                TextInput::make('noinvoice')
                    ->label('No. Invoice')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Diisi otomatis dari data API'),

                Select::make('jenis')
                    ->label('Jenis Sohibul')
                    ->options(SohibulSapi::JENIS_OPTIONS)
                    ->required(),

                TextInput::make('no_sohibul')
                    ->label('No. Sohibul')
                    ->required()
                    ->helperText('Otomatis digenerate. Jika sudah terpakai, akan diperbarui otomatis saat simpan.'),

                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                TextInput::make('nama_kk')
                    ->label('Nama Kepala Keluarga')
                    ->required(),

                TextInput::make('nohp')
                    ->label('No. HP / WA')
                    ->tel(),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(2),

                Select::make('rt')
                    ->label('RT')
                    ->options(self::rtOptions())
                    ->live()
                    ->afterStateUpdated(function (?string $state, Set $set): void {
                        if ($state === 'non_warga' || $state === null) {
                            $set('rw', null);
                        } else {
                            $set('rw', SohibulSapi::RT_RW_MAP[$state] ?? null);
                        }
                    })
                    ->helperText('Pilih RT (30–47) untuk warga Jogokariyan, atau Non Warga untuk luar'),

                TextInput::make('rw')
                    ->label('RW')
                    ->disabled()
                    ->dehydrated()
                    ->placeholder(fn (Get $get): string =>
                        $get('rt') === 'non_warga' || $get('rt') === null
                            ? 'Tidak ada (Luar / belum pilih RT)'
                            : ''
                    )
                    ->helperText('Terisi otomatis sesuai RT yang dipilih'),

                Select::make('bagiansohibul')
                    ->label('Bagian Sohibul')
                    ->options(SohibulSapi::BAGIAN_OPTIONS)
                    ->placeholder('— Pilih —'),

                TextInput::make('nilaisepertuju')
                    ->label('Nilai Sepertuju (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Otomatis sesuai jenis. Khusus PRIBADI isi manual.'),

                Select::make('posisidana')
                    ->label('Posisi Dana')
                    ->options(SohibulSapi::POSISI_OPTIONS)
                    ->required(),

                TextInput::make('kwitansi')
                    ->label('Link Kwitansi')
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Link otomatis dari invoice number'),

                TextInput::make('urlmap')
                    ->label('URL Google Maps')
                    ->url()
                    ->helperText('Isi manual jika diperlukan'),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3),
            ])
            ->action(function (array $data): void {
                // Pastikan no_sohibul unik — loop jika collision
                $noSohibul = $data['no_sohibul'];
                while (SohibulSapi::where('no_sohibul', $noSohibul)->exists()) {
                    $noSohibul = SohibulSapi::nextNoSohibul($data['jenis']);
                }

                SohibulSapi::create([
                    'noinvoice'      => $data['noinvoice'],
                    'no_sohibul'     => $noSohibul,
                    'nama'           => $data['nama'],
                    'nama_kk'        => $data['nama_kk'],
                    'nohp'           => $data['nohp']      ?? null,
                    'alamat'         => $data['alamat']    ?? '',
                    'rt'             => $data['rt']        ?? 'non_warga',
                    'rw'             => $data['rw']        ?? null,
                    'jenis'          => $data['jenis'],
                    'bagiansohibul'  => $data['bagiansohibul'] ?? 'diantarkan',
                    'nilaisepertuju' => $data['nilaisepertuju'] ?? null,
                    'posisidana'     => $data['posisidana'],
                    'kwitansi'       => $data['kwitansi']  ?? null,
                    'urlmap'         => $data['urlmap']    ?? null,
                    'keterangan'     => $data['keterangan'] ?? null,
                    'status'         => 0,
                    'pj'             => null,
                ]);

                // Refresh daftar noinvoice yang sudah ada
                $this->existingNoinvoices = SohibulSapi::whereNotNull('noinvoice')
                    ->pluck('noinvoice')
                    ->toArray();

                $this->dispatch('notify', [
                    'message' => 'Data berhasil disimpan ke Sohibul Sapi!',
                    'type'    => 'success',
                ]);
            });
    }

    // ── Misc ─────────────────────────────────────────────────────

    public function refresh(): void
    {
        Cache::forget('qurban_api_data');
        $this->loadData();
        $this->dispatch('notify', ['message' => 'Data berhasil diperbarui', 'type' => 'success']);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('🔄 Refresh Data')
                ->color('primary')
                ->action('refresh'),
        ];
    }

    public function getTitle(): string { return 'Data Invoice Qurban Online'; }
}
