<?php

namespace App\Filament\Resources\ActivityLog;

use App\Filament\Resources\ActivityLog\Pages;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\HtmlString;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationLabel = 'Log Aktivitas';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminsohibul', 'bendaharasapi']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                
                TextColumn::make('causer.name')
                    ->label('User')
                    ->placeholder('Sistem'),
                
                TextColumn::make('description')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default   => 'gray',
                    }),
                
                TextColumn::make('subject_type')
                    ->label('Data')
                    ->formatStateUsing(fn($state) => class_basename($state)),

                TextColumn::make('subject_id')
                    ->label('ID Ref'),

                TextColumn::make('properties')
                    ->label('Perubahan')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';
                        
                        $old = $state['old'] ?? [];
                        $new = $state['attributes'] ?? [];
                        
                        if (empty($old) && empty($new)) return '-';

                        $out = '<div class="text-[10px] leading-tight">';
                        
                        // Jika created
                        if (empty($old) && !empty($new)) {
                            foreach ($new as $key => $val) {
                                if ($key === 'updated_at' || $key === 'created_at') continue;
                                $out .= "<div><span class='font-bold'>{$key}</span>: " . e($val) . "</div>";
                            }
                        } else {
                            // Jika updated
                            foreach ($new as $key => $val) {
                                if ($key === 'updated_at') continue;
                                $oldVal = $old[$key] ?? '—';
                                if ($oldVal == $val) continue;
                                
                                $out .= "<div class='mb-1'><strong>{$key}</strong>: <br>"
                                      . "<span class='text-red-500 line-through'>" . e($oldVal) . "</span> &rarr; "
                                      . "<span class='text-green-600 font-medium'>" . e($val) . "</span></div>";
                            }
                        }
                        
                        $out .= '</div>';
                        return new HtmlString($out);
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }
}
