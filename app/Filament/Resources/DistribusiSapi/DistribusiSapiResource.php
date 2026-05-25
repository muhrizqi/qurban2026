<?php

namespace App\Filament\Resources\DistribusiSapi;

use App\Filament\Resources\DistribusiSapi\Pages;
use App\Models\SohibulSapi;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DistribusiSapiResource extends Resource
{
    protected static ?string $model = SohibulSapi::class;
    protected static ?string $slug = 'distribusi-sapi';
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-truck';
    protected static UnitEnum|string|null $navigationGroup = 'Distribusi Sapi';

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return false; // navigasi dikelola oleh masing-masing custom page
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('no_sohibul')->label('No.')->sortable()->searchable(),
            TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
            TextColumn::make('jenis')->label('Jenis')->badge(),
            TextColumn::make('alamat')
                ->label('Alamat & Kontak')
                ->html()
                ->formatStateUsing(function ($state, SohibulSapi $record): string {
                    $out = 'RT ' . e($record->rt) . ' / RW ' . e($record->rw ?? '-') . '<br>' . e($state);
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
                ->formatStateUsing(fn ($state) => SohibulSapi::BAGIAN_OPTIONS[$state] ?? $state),
            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->formatStateUsing(fn ($state) => SohibulSapi::STATUS_LABEL[$state] ?? '-')
                ->color(fn ($state) => SohibulSapi::STATUS_COLOR[$state] ?? 'gray'),
            TextColumn::make('penanggungJawab.name')
                ->label('PJ')
                ->default('-'),
        ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\TugasDistribusi::route('/'),
            'tugas'   => Pages\TugasDistribusi::route('/tugas'),
            'reguler' => Pages\ListDistribusiReguler::route('/reguler'),
            'super'   => Pages\ListDistribusiSuper::route('/super'),
            'duper'   => Pages\ListDistribusiDuper::route('/duper'),
            'pribadi' => Pages\ListDistribusiPribadi::route('/pribadi'),
            'rw9'     => Pages\ListDistribusiRW9::route('/rw9'),
            'rw10'    => Pages\ListDistribusiRW10::route('/rw10'),
            'rw11'    => Pages\ListDistribusiRW11::route('/rw11'),
            'rw12'    => Pages\ListDistribusiRW12::route('/rw12'),
            'luar'    => Pages\ListDistribusiLuar::route('/luar'),
            'tidak_diambil'   => Pages\ListDistribusiTidakDiambil::route('/tidak-diambil'),
            'diambil_sendiri' => Pages\ListDistribusiDiambilSendiri::route('/diambil-sendiri'),
        ];
    }
}
