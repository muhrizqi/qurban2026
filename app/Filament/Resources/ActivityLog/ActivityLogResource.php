<?php

namespace App\Filament\Resources\ActivityLog;

use App\Models\SohibulSapi;
use BackedEnum;
use UnitEnum;
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
    protected static UnitEnum|string|null $navigationGroup = 'Sistem';
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-list';

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
                    ->color(fn ($state, Activity $record): string => match ($record->event) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default   => 'gray',
                    }),
                
                TextColumn::make('no_sohibul')
                    ->label('No Sohibul')
                    ->getStateUsing(function ($record) {
                        $props = $record->properties;
                        if (is_string($props)) $props = json_decode($props, true);
                        
                        return $props['attributes']['no_sohibul'] ?? 
                               $record->subject?->no_sohibul ?? 
                               (str_contains($record->description, 'sohibul ') ? str_after($record->description, 'sohibul ') : '-');
                    })
                    ->searchable(),

                TextColumn::make('subject_type')
                    ->label('Data')
                    ->formatStateUsing(fn($state) => class_basename($state)),

                TextColumn::make('subject_id')
                    ->label('ID Ref'),

                TextColumn::make('properties')
                    ->label('Perubahan')
                    ->html()
                    ->formatStateUsing(function ($state, Activity $record) {
                        if (!$state) return '-';
                        
                        $event = (string) $record->event;
                        
                        // Coba decode jika masih string (antisipasi masalah casting)
                        $properties = $state;
                        if (is_string($properties)) {
                            $properties = json_decode($properties, true);
                        } elseif (is_object($properties) && method_exists($properties, 'toArray')) {
                            $properties = $properties->toArray();
                        }
                        
                        if (!is_array($properties)) return '-';
                        
                        $old = $properties['old'] ?? [];
                        $new = $properties['attributes'] ?? [];
                        
                        if (empty($old) && empty($new)) return '-';

                        $out = '<div style="font-size: 11px; line-height: 1.2;">';
                        
                        // Jika created
                        if ($event === 'created') {
                            $data = !empty($new) ? $new : $properties;
                            $noSohibul = $data['no_sohibul'] ?? '-';
                            $nama = $data['nama'] ?? '-';
                            $out .= "<div style='margin-bottom: 8px; color: #2563eb; font-weight: bold; font-size: 13px;'>Data Baru: {$noSohibul} ({$nama})</div>";
                            
                            foreach ($data as $key => $val) {
                                if (in_array($key, ['updated_at', 'created_at', 'id'])) continue;
                                if (is_array($val)) $val = json_encode($val);
                                $out .= "<div><span style='font-weight: bold;'>{$key}</span>: " . e($val) . "</div>";
                            }
                        } else {
                            // Jika updated atau lainnya
                            if (empty($new)) return '-';
                            
                            foreach ($new as $key => $val) {
                                if ($key === 'updated_at') continue;
                                $oldVal = $old[$key] ?? '—';
                                if ($oldVal == $val) continue;
                                
                                if (is_array($val)) $val = json_encode($val);
                                if (is_array($oldVal)) $oldVal = json_encode($oldVal);
                                
                                $out .= "<div style='margin-bottom: 4px;'><strong>{$key}</strong>: <br>"
                                      . "<span style='color: #ef4444; text-decoration: line-through;'>" . e($oldVal) . "</span> &rarr; "
                                      . "<span style='color: #16a34a; font-weight: 500;'>" . e($val) . "</span></div>";
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
