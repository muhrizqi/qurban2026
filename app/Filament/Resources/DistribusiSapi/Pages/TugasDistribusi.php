<?php

namespace App\Filament\Resources\DistribusiSapi\Pages;

use App\Filament\Resources\DistribusiSapi\DistribusiSapiResource;
use App\Filament\Widgets\TugasLainAktifWidget;
use App\Filament\Widgets\TugasLainSelesaiWidget;
use App\Filament\Widgets\TugasSelesaiWidget;
use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

/**
 * Halaman TUGAS:
 * - distribusisapi : [tabel 1] tugas saya aktif  + [widget] tugas saya selesai
 * - adminsapi      : [tabel 1] tugas saya aktif  + [widget 1] tugas saya selesai
 *                                                + [widget 2] tugas PJ lain aktif
 *                                                + [widget 3] tugas PJ lain selesai
 */
class TugasDistribusi extends ListRecords
{
    protected static string $resource = DistribusiSapiResource::class;

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']);
    }

    public static function getNavigationGroup(): ?string { return 'Distribusi Sapi'; }
    public static function getNavigationLabel(): string  { return 'TUGAS'; }
    public static function getNavigationSort(): ?int     { return 1; }
    public static function getNavigationIcon(): string   { return 'heroicon-o-clipboard-document-list'; }

    public function getTitle(): string { return 'Tugas Distribusi Saya'; }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\DistribusiStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        $user = auth()->user();

        // adminsapi: 3 widget (saya selesai + lain aktif + lain selesai)
        if ($user?->hasRole('adminsapi')) {
            return [
                TugasSelesaiWidget::class,
                TugasLainAktifWidget::class,
                TugasLainSelesaiWidget::class,
            ];
        }

        // distribusisapi: hanya tugas sendiri yang selesai
        return [
            TugasSelesaiWidget::class,
        ];
    }

    public function table(Table $table): Table
    {
        $myId = auth()->id();

        return $table
            ->heading('🚚 Tugas Saya — Sedang Dikerjakan')
            ->description('Sohibul yang sedang Anda antarkan')
            ->modifyQueryUsing(
                fn (Builder $query) => $query
                    ->where('status', 1)
                    ->where('pj', $myId)        // selalu filter pj=saya
            )
            ->columns([
                TextColumn::make('no_sohibul')->label('No.')->sortable(),
                TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
                TextColumn::make('jenis')->label('Jenis')->badge(),
                TextColumn::make('alamat')
                    ->label('Alamat & Maps')
                    ->html()
                    ->formatStateUsing(function ($state, SohibulSapi $record): string {
                        $out = 'RT ' . e($record->rt) . '/RW ' . e($record->rw ?? '-') . '<br>' . e($state);
                        if ($record->nohp) {
                            $out .= '<br><small>📱 ' . e($record->nohp) . '</small>';
                        }
                        if ($record->urlmap) {
                            $out .= '<br><a href="' . e($record->urlmap) . '" target="_blank" '
                                  . 'class="text-green-600 text-xs">📍 Maps</a>';
                        }
                        return $out;
                    })
                    ->wrap(),
                TextColumn::make('bagiansohibul')
                    ->label('Bagian')
                    ->badge()
                    ->formatStateUsing(fn ($state) => SohibulSapi::BAGIAN_OPTIONS[$state] ?? $state),
            ])
            ->defaultSort('no_sohibul')
            ->filters([])
            ->actions([
                Action::make('selesai')
                    ->label('✅ Selesai')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Selesai')
                    ->modalDescription('Tandai sohibul ini sebagai SUDAH TERKIRIM?')
                    ->action(fn (SohibulSapi $record) => $record->update(['status' => 2])),

                Action::make('batal')
                    ->label('❌ Batal')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembatalan')
                    ->modalDescription('Batalkan tugas ini? Status kembali ke Belum Terkirim.')
                    ->action(fn (SohibulSapi $record) => $record->update(['status' => 0, 'pj' => null])),
            ])
            ->bulkActions([])
            ->emptyStateHeading('Tidak ada tugas aktif')
            ->emptyStateDescription('Ambil tugas dari menu kategori (REGULER, SUPER, dll).')
            ->emptyStateIcon('heroicon-o-clipboard-document-list');
    }
}
