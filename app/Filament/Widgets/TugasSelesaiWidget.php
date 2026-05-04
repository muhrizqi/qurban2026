<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * Tugas yang sudah saya selesaikan sendiri (status=2, pj=me)
 */
class TugasSelesaiWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']) ?? false;
    }
    protected static ?string $heading = '✅ Tugas Saya — Sudah Selesai';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $myId = auth()->id();

        return $table
            ->query(
                SohibulSapi::query()
                    ->where('status', 2)
                    ->where('pj', $myId)
            )
            ->columns($this->columns())
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Action::make('batal_sendiri')
                    ->label('❌ Batalkan')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Tugas Selesai')
                    ->modalDescription('Batalkan tugas ini? Status akan kembali ke Belum Terkirim.')
                    ->action(fn (SohibulSapi $record) => $record->update(['status' => 0, 'pj' => null])),
            ])
            ->emptyStateHeading('Belum ada tugas yang Anda selesaikan')
            ->emptyStateIcon('heroicon-o-check-circle');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('no_sohibul')->label('No.')->sortable(),
            TextColumn::make('nama')->label('Nama')->searchable(),
            TextColumn::make('jenis')->label('Jenis')->badge(),
            TextColumn::make('alamat')
                ->label('Alamat')
                ->html()
                ->formatStateUsing(fn ($state, SohibulSapi $r) =>
                    'RT '  . e($r->rt) . '/RW ' . e($r->rw ?? '-') . '<br>' . e($state)
                    . ($r->urlmap ? ' <a href="' . e($r->urlmap) . '" target="_blank" class="text-green-600 text-xs">📍</a>' : '')
                )->wrap(),
            TextColumn::make('updated_at')->label('Selesai Pada')->dateTime('d M Y H:i')->sortable(),
        ];
    }
}
