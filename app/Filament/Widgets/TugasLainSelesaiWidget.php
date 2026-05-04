<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * Tugas PJ lain yang sudah diselesaikan (status=2, pj!=me)
 * Hanya untuk adminsapi.
 */
class TugasLainSelesaiWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('adminsapi') ?? false;
    }
    protected static ?string $heading = '✅ Tugas PJ Lain — Sudah Selesai';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $myId = auth()->id();

        return $table
            ->query(
                SohibulSapi::query()
                    ->where('status', 2)
                    ->where('pj', '!=', $myId)
            )
            ->columns([
                TextColumn::make('no_sohibul')->label('No.')->sortable(),
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('jenis')->label('Jenis')->badge(),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->html()
                    ->formatStateUsing(fn ($state, SohibulSapi $r) =>
                        'RT ' . e($r->rt) . '/RW ' . e($r->rw ?? '-') . '<br>' . e($state)
                        . ($r->urlmap ? ' <a href="' . e($r->urlmap) . '" target="_blank" class="text-green-600 text-xs">📍</a>' : '')
                    )->wrap(),
                TextColumn::make('penanggungJawab.name')
                    ->label('Diselesaikan Oleh')
                    ->default('-')
                    ->badge()
                    ->color('success'),
                TextColumn::make('updated_at')
                    ->label('Selesai Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Action::make('batal_selesai')
                    ->label('❌ Batalkan')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Penyelesaian Tugas')
                    ->modalDescription('Batalkan tugas yang sudah selesai ini? Status akan kembali ke Belum Terkirim dan PJ akan dihapus.')
                    ->action(fn (SohibulSapi $record) => $record->update(['status' => 0, 'pj' => null])),
            ])
            ->emptyStateHeading('Belum ada tugas selesai dari PJ lain')
            ->emptyStateIcon('heroicon-o-check-badge');
    }
}
