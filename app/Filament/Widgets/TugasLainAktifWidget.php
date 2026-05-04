<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * Tugas PJ lain yang sedang dalam proses (status=1, pj!=me)
 * Hanya untuk adminsapi.
 */
class TugasLainAktifWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('adminsapi') ?? false;
    }
    protected static ?string $heading = '🚚 Tugas PJ Lain — Sedang Dikerjakan';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $myId = auth()->id();

        return $table
            ->query(
                SohibulSapi::query()
                    ->where('status', 1)
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
                    ->label('Dikerjakan Oleh')
                    ->default('-')
                    ->badge()
                    ->color('warning'),
            ])
            ->defaultSort('no_sohibul')
            ->actions([
                Action::make('batal_lain')
                    ->label('❌ Batalkan')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Tugas PJ Lain')
                    ->modalDescription('Batalkan tugas ini? Status akan kembali ke Belum Terkirim dan PJ akan dihapus.')
                    ->action(fn (SohibulSapi $record) => $record->update(['status' => 0, 'pj' => null])),
            ])
            ->emptyStateHeading('Tidak ada tugas aktif dari PJ lain')
            ->emptyStateIcon('heroicon-o-users');
    }
}
