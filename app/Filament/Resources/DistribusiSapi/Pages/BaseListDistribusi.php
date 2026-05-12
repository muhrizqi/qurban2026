<?php

namespace App\Filament\Resources\DistribusiSapi\Pages;

use App\Filament\Resources\DistribusiSapi\DistribusiSapiResource;
use App\Models\SohibulSapi;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Base class untuk list distribusi (Reguler, Super, Duper, dll.).
 * Menampilkan checkbox dan tombol bulk "Antarkan".
 */
abstract class BaseListDistribusi extends ListRecords
{
    protected static string $resource = DistribusiSapiResource::class;

    protected ?string $filterJenis  = null;
    protected ?string $filterRw     = null;
    protected ?string $filterBagian = null;
    protected bool    $filterLuar   = false;

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']);
    }

    public static function getNavigationGroup(): ?string { return 'Distribusi Sapi'; }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\DistribusiStatsWidget::class,
        ];
    }

    public function getWidgetData(): array
    {
        return [
            'filterJenis'  => $this->filterJenis,
            'filterRw'     => $this->filterRw,
            'filterBagian' => $this->filterBagian,
            'filterLuar'   => $this->filterLuar,
        ];
    }

    public function table(Table $table): Table
    {
        $filterJenis  = $this->filterJenis;
        $filterRw     = $this->filterRw;
        $filterBagian = $this->filterBagian;
        $filterLuar   = $this->filterLuar;

        $count = SohibulSapi::query()
            ->when($filterJenis,  fn ($q) => $q->where('jenis', $filterJenis))
            ->when($filterRw,     fn ($q) => $q->where('rw', $filterRw))
            ->when($filterBagian, fn ($q) => $q->where('bagiansohibul', $filterBagian))
            ->when($filterLuar,   fn ($q) => $q->where('rt', 'non_warga'))
            ->count();

        return $table
            ->description("Total: {$count} sohibul")
            ->modifyQueryUsing(function (Builder $query) use ($filterJenis, $filterRw, $filterBagian, $filterLuar) {
                $isAdmin = auth()->user()?->hasRole('adminsapi');

                $query
                    ->when($filterJenis,  fn ($q) => $q->where('jenis', $filterJenis))
                    ->when($filterRw,     fn ($q) => $q->where('rw', $filterRw))
                    ->when($filterBagian, fn ($q) => $q->where('bagiansohibul', $filterBagian))
                    ->when($filterLuar,   fn ($q) => $q->where('rt', 'non_warga'));

                // Urutkan: yang bisa dipilih dulu, yang tidak bisa di bawah
                if ($isAdmin) {
                    // adminsapi: hanya record ber-PJ yang ke bawah
                    $query->orderByRaw('CASE WHEN pj IS NULL THEN 0 ELSE 1 END ASC');
                } else {
                    // distribusisapi: bisa dipilih dulu, tidak_diambil tengah, ber-PJ paling bawah
                    $query->orderByRaw("
                        CASE
                            WHEN pj IS NULL AND bagiansohibul != 'tidak_diambil' THEN 0
                            WHEN pj IS NULL AND bagiansohibul  = 'tidak_diambil' THEN 1
                            ELSE 2
                        END ASC
                    ");
                }

                $query->orderBy('no_sohibul');
            })
            ->columns([
                TextColumn::make('no_sohibul')->label('No.')->sortable()->searchable(),
                TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->hidden(fn () => auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap'])),
                TextColumn::make('alamat')
                    ->label('Alamat & Maps')
                    ->html()
                    ->formatStateUsing(function ($state, SohibulSapi $record): string {
                        $isMobileRole = auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap']);
                        
                        $out = 'RT ' . e($record->rt) . ' / RW ' . e($record->rw ?? '-') . '<br>' . e($state);

                        // Jenis & Bagian dimasukkan jika role mobile
                        if ($isMobileRole) {
                            $jenisLabel  = $record->jenis ?? '-';
                            $bagianLabel = SohibulSapi::BAGIAN_OPTIONS[$record->bagiansohibul] ?? ($record->bagiansohibul ?? '-');
                            $out .= '<br><small style="color:#6366f1;font-weight:600">🐄 ' . e($jenisLabel)
                                  . ' &nbsp;|&nbsp; 📦 ' . e($bagianLabel) . '</small>';
                        }

                        if ($record->nohp) {
                            $out .= '<br><small>📱 ' . e($record->nohp) . '</small>';
                        }
                        if ($record->urlmap) {
                            $out .= '<br><a href="' . e($record->urlmap) . '" target="_blank" class="text-green-600 text-xs">📍 Maps</a>';
                        }
                        return $out;
                    })
                    ->wrap(),
                TextColumn::make('bagiansohibul')
                    ->label('Bagian')
                    ->badge()
                    ->formatStateUsing(fn ($state) => SohibulSapi::BAGIAN_OPTIONS[$state] ?? $state)
                    ->hidden(fn () => auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap'])),
                TextColumn::make('status')
                    ->label(fn () => auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap']) ? 'Status / PJ' : 'Status')
                    ->badge()
                    ->html()
                    ->formatStateUsing(function ($state, SohibulSapi $record): string {
                        $isMobileRole = auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap']);
                        $statusLabel = SohibulSapi::STATUS_LABEL[$state] ?? '-';
                        $out = e($statusLabel);
                        
                        // Tampilkan nama PJ di bawah status jika role mobile
                        if ($isMobileRole && $record->penanggungJawab) {
                            $out .= '<br><small style="font-weight:600;color:#374151">👤 ' . e($record->penanggungJawab->name) . '</small>';
                        }
                        return $out;
                    })
                    ->color(fn ($state) => SohibulSapi::STATUS_COLOR[$state] ?? 'gray'),
                TextColumn::make('penanggungJawab.name')
                    ->label('PJ')
                    ->default('-')
                    ->hidden(fn () => auth()->user()?->hasAnyRole(['distribusisapi', 'adminsapi', 'petugasmap'])),
            ])

            ->defaultSort('no_sohibul')
            ->filters([])
            ->actions([])
            ->checkIfRecordIsSelectableUsing(function (SohibulSapi $record): bool {
                // Sudah ada PJ → tidak bisa dipilih siapapun
                if (! is_null($record->pj)) {
                    return false;
                }

                $user = auth()->user();
                // adminsapi boleh pilih semua yang belum ada PJ
                if ($user?->hasRole('adminsapi')) {
                    return true;
                }
                // distribusisapi tidak bisa pilih bagian Tidak Diambil
                return $record->bagiansohibul !== 'tidak_diambil';
            })
            ->bulkActions([
                BulkAction::make('antarkan')
                    ->label('🚚 Antarkan')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pengambilan Tugas')
                    ->modalDescription(fn (Collection $records) =>
                        'Apakah Anda yakin mau mengambil tugas mengantarkan ' .
                        $records->count() . ' sohibul ini?'
                    )
                    ->action(function (Collection $records): void {
                        $pjId = auth()->id();
                        $records->each(fn (SohibulSapi $record) =>
                            $record->update(['status' => 1, 'pj' => $pjId])
                        );
                    })
                    ->deselectRecordsAfterCompletion(),
            ])
            ->emptyStateHeading('Belum ada data distribusi')
            ->emptyStateDescription('Belum ada sohibul yang perlu diantarkan di kategori ini.')
            ->emptyStateIcon('heroicon-o-truck');
    }
}
