<?php

namespace App\Filament\Resources\SohibulSapi\Pages;

use App\Filament\Resources\SohibulSapi\SohibulSapiResource;
use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action as TableAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;

/**
 * Base class untuk semua halaman list Sohibul Sapi (admin/bendaharasapi).
 */
abstract class BaseListSohibulSapi extends ListRecords
{
    protected static string $resource = SohibulSapiResource::class;

    protected ?string $filterJenis  = null;
    protected ?string $filterRw     = null;
    protected ?string $filterPosisi = null;
    protected bool    $filterLuar   = false;
    protected string  $jenisLabel   = 'Sohibul';

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminsohibul', 'bendaharasapi']);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Sohibul Sapi';
    }

    // ── Tombol Tambah di header halaman ──────────────────────────
    protected function getHeaderActions(): array
    {
        $jenis = $this->filterJenis;
        return [
            Action::make('tambah')
                ->label('Tambah ' . $this->jenisLabel)
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(
                    SohibulSapiResource::getUrl('create')
                    . ($jenis ? '?jenis=' . $jenis : '')
                ),
        ];
    }

    // ── Konfigurasi Tabel ─────────────────────────────────────────
    public function table(Table $table): Table
    {
        $filterJenis = $this->filterJenis;
        $filterRw    = $this->filterRw;
        $filterLuar  = $this->filterLuar;

        // Hitung total sohibul untuk info di heading tabel
        $count = SohibulSapi::query()
            ->when($filterJenis,  fn ($q) => $q->where('jenis', $filterJenis))
            ->when($filterRw,     fn ($q) => $q->where('rw', $filterRw))
            ->when($filterLuar,   fn ($q) => $q->where('rt', 'non_warga'))
            ->when($this->filterPosisi, fn ($q) => $q->where('posisidana', $this->filterPosisi))
            ->count();

        return $table
            ->heading($this->getTitle())
            ->description("Total: {$count} sohibul")
            ->modifyQueryUsing(function (Builder $query) use ($filterJenis, $filterRw, $filterLuar) {
                $query
                    ->when($filterJenis,  fn ($q) => $q->where('jenis', $filterJenis))
                    ->when($filterRw,     fn ($q) => $q->where('rw', $filterRw))
                    ->when($filterLuar,   fn ($q) => $q->where('rt', 'non_warga'))
                    ->when($this->filterPosisi, fn ($q) => $q->where('posisidana', $this->filterPosisi));

                // Sort numerik: abaikan prefix (R, S, D, PB) — ambil angkanya saja
                $driver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
                if ($filterJenis) {
                    // Halaman per-jenis: prefix tetap, sort angka di belakang prefix
                    $prefixLen = strlen(\App\Models\SohibulSapi::JENIS_PREFIX[$filterJenis] ?? '');
                    if ($driver === 'pgsql') {
                        $query->orderByRaw('CAST(SUBSTR(no_sohibul, ' . ($prefixLen + 1) . ') AS INTEGER) ASC');
                    } else {
                        $query->orderByRaw('CAST(SUBSTR(no_sohibul, ' . ($prefixLen + 1) . ') AS UNSIGNED) ASC');
                    }
                } else {
                    // Halaman per-RW atau Luar: sort by jenis dulu, lalu angka numerik
                    if ($driver === 'pgsql') {
                        $query->orderBy('jenis')
                              ->orderByRaw("CAST(REGEXP_REPLACE(no_sohibul, '[^0-9]', '', 'g') AS INTEGER) ASC");
                    } else {
                        $query->orderBy('jenis')
                              ->orderByRaw("CAST(TRIM(no_sohibul, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') AS UNSIGNED) ASC");
                    }
                }
            })
            ->columns([
                TextColumn::make('no_sohibul')
                    ->label('No. Sohibul')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                // Alamat + nohp + link kwitansi + link urlmap
                TextColumn::make('alamat')
                    ->label('Alamat & Kontak')
                    ->html()
                    ->formatStateUsing(function ($state, SohibulSapi $record): string {
                        $out = e($state);
                        if ($record->nohp) {
                            $out .= '<br><small>📱 ' . e($record->nohp) . '</small>';
                        }
                        if ($record->kwitansi) {
                            $url  = asset('storage/' . $record->kwitansi);
                            $out .= ' &nbsp;<a href="' . $url . '" target="_blank" '
                                  . 'style="color:#2563eb;font-size:0.75rem">📄 Kwitansi</a>';
                        }
                        if ($record->urlmap) {
                            $out .= ' &nbsp;<a href="' . e($record->urlmap) . '" target="_blank" '
                                  . 'style="color:#16a34a;font-size:0.75rem">📍 Maps</a>';
                        }
                        return $out;
                    })
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => SohibulSapi::STATUS_LABEL[$state] ?? '-')
                    ->color(fn ($state) => SohibulSapi::STATUS_COLOR[$state] ?? 'gray')
                    ->hidden(fn () => auth()->user()?->hasAnyRole(['admin', 'adminsohibul'])),
            ])
            ->filters([])
            ->actions([
                ViewAction::make()->label('')->tooltip('Lihat'),
                
                // Tombol Cetak Kuitansi PDF (Khusus adminsohibul/admin, Rek Qurban, Belum ada kwitansi)
                TableAction::make('cetak_kuitansi')
                    ->label('')
                    ->tooltip('Cetak Kuitansi PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(fn (SohibulSapi $record) => route('sohibul.kuitansi.pdf', $record))
                    ->openUrlInNewTab()
                    ->visible(fn (SohibulSapi $record) => 
                        auth()->user()?->hasAnyRole(['admin', 'adminsohibul']) 
                        && $record->posisidana === 'Rek Qurban' 
                        && empty($record->kwitansi)
                    ),

                EditAction::make()
                    ->label('')
                    ->tooltip('Edit')
                    ->hidden(fn (SohibulSapi $record): bool =>
                        auth()->user()?->hasRole('adminsohibul')
                        && $record->posisidana === 'Kas'
                    ),
                DeleteAction::make()
                    ->label('')
                    ->tooltip('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Data Sohibul')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->hidden(fn (SohibulSapi $record): bool =>
                        auth()->user()?->hasRole('adminsohibul')
                        && $record->posisidana === 'Kas'
                    ),
            ])
            ->bulkActions([])
            // ── Empty state saat tidak ada data ──────────────────
            ->emptyStateHeading('Belum ada data ' . ($this->jenisLabel === 'Sohibul' ? 'sohibul' : $this->jenisLabel))
            ->emptyStateDescription('Klik tombol "Tambah ' . $this->jenisLabel . '" di atas untuk menambah data baru.')
            ->emptyStateIcon('heroicon-o-users');
    }
}
