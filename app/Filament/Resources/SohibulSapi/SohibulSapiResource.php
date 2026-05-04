<?php

namespace App\Filament\Resources\SohibulSapi;

use App\Filament\Resources\SohibulSapi\Pages;
use App\Models\SohibulSapi;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;

class SohibulSapiResource extends Resource
{
    protected static ?string $model = SohibulSapi::class;
    protected static ?string $slug = 'sohibul-sapi';
    protected static ?string $navigationLabel = 'Sohibul Sapi';
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-users';
    protected static UnitEnum|string|null $navigationGroup = 'Sohibul Sapi';

    public static function shouldRegisterNavigation(): bool
    {
        return false; // navigasi dikelola oleh masing-masing custom page
    }

    // ── RT options ───────────────────────────────────────────────
    private static function rtOptions(): array
    {
        $opts = ['non_warga' => 'Non Warga (Luar Jogokariyan)'];
        foreach (range(30, 47) as $rt) {
            $opts[(string) $rt] = 'RT ' . $rt;
        }
        return $opts;
    }

    // ── Form ─────────────────────────────────────────────────────
    public static function form(Schema $schema): Schema
    {
        $user             = auth()->user();
        $isAdminBendahara = $user?->hasAnyRole(['admin', 'adminsohibul', 'bendaharasapi']);

        return $schema->components([

            // ── Jenis ──────────────────────────────────────────
            Select::make('jenis')
                ->label('Jenis Sohibul')
                ->options(SohibulSapi::JENIS_OPTIONS)
                ->required()
                ->live()
                ->afterStateUpdated(function (?string $state, Set $set, Get $get, $record) {
                    if (! $state) return;

                    // Auto-fill nilaisepertuju
                    $set('nilaisepertuju', SohibulSapi::NILAI_DEFAULT[$state] ?? null);

                    // Auto-suggest no_sohibul hanya saat create (record null)
                    if (! $record) {
                        $set('no_sohibul', SohibulSapi::nextNoSohibul($state));
                    }
                }),

            // ── No Sohibul ─────────────────────────────────────
            TextInput::make('no_sohibul')
                ->label('No. Sohibul')
                ->required()
                ->maxLength(20)
                ->rule(fn (Get $get, ?Model $record): Closure =>
                    function (string $attribute, mixed $value, Closure $fail) use ($get, $record): void {
                        $query = SohibulSapi::where('no_sohibul', $value);
                        // Saat edit: abaikan record sendiri
                        if ($record?->id) {
                            $query->where('id', '!=', $record->id);
                        }
                        if ($query->exists()) {
                            $jenis     = $get('jenis') ?: 'REGULER';
                            $suggested = SohibulSapi::nextNoSohibul($jenis);
                            $fail("Maaf, No. Sohibul \"{$value}\" sudah ada yang pakai. "
                                . "Kami sarankan gunakan: {$suggested}");
                        }
                    }
                ),

            // ── Nama ───────────────────────────────────────────
            TextInput::make('nama')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            // ── Nama KK ────────────────────────────────────────
            TextInput::make('nama_kk')
                ->label('Nama Kepala Keluarga')
                ->required()
                ->maxLength(255),

            // ── No HP ──────────────────────────────────────────
            TextInput::make('nohp')
                ->label('No. HP / WA')
                ->tel()
                ->maxLength(20),

            // ── Alamat ─────────────────────────────────────────
            Textarea::make('alamat')
                ->label('Alamat')
                ->required()
                ->rows(2),

            // ── RT ─────────────────────────────────────────────
            Select::make('rt')
                ->label('RT')
                ->options(static::rtOptions())
                ->required()
                ->live()
                ->afterStateUpdated(function (?string $state, Set $set) {
                    if ($state === 'non_warga') {
                        $set('rw', null);
                        $set('bagiansohibul', 'tidak_diambil'); // default luar
                    } else {
                        $rw = SohibulSapi::RT_RW_MAP[$state] ?? null;
                        $set('rw', $rw);
                        $set('bagiansohibul', 'diantarkan'); // default warga
                    }
                }),

            // ── RW ─────────────────────────────────────────────
            TextInput::make('rw')
                ->label('RW')
                ->disabled()
                ->dehydrated()
                ->maxLength(5),

            // ── Bagian Sohibul ─────────────────────────────────
            Select::make('bagiansohibul')
                ->label('Bagian Sohibul')
                ->options(SohibulSapi::BAGIAN_OPTIONS)
                ->required()
                ->default('diantarkan'),

            // ── Nilai Sepertuju ────────────────────────────────
            TextInput::make('nilaisepertuju')
                ->label('Nilai Sepertuju (Rp)')
                ->numeric()
                ->prefix('Rp')
                ->live()
                ->disabled(fn (Get $get) => $get('jenis') !== 'PRIBADI' && $get('jenis') !== null && $get('jenis') !== '')
                ->dehydrated()
                ->helperText('Otomatis terisi sesuai jenis. Khusus PRIBADI diisi manual.'),

            // ── Posisi Dana ────────────────────────────────────
            Select::make('posisidana')
                ->label('Posisi Dana')
                ->options(SohibulSapi::POSISI_OPTIONS)
                ->required(),

            // ── Kwitansi ───────────────────────────────────────
            FileUpload::make('kwitansi')
                ->label('Foto Kwitansi')
                ->image()
                ->disk('public')
                ->directory('kwitansi')
                ->imagePreviewHeight('200')
                ->nullable(),

            // ── URL Maps ───────────────────────────────────────
            TextInput::make('urlmap')
                ->label('URL Google Maps')
                ->url()
                ->maxLength(500)
                ->hint(new HtmlString(
                    '<span'
                    . ' style="display:inline-flex;align-items:center;gap:4px;cursor:pointer;'
                    . 'color:#2563eb;font-size:0.75rem;font-weight:500;"'
                    . ' title="Klik untuk mengisi otomatis dari GPS HP Anda"'
                    . ' @click.prevent="'
                    . 'if(!navigator.geolocation){alert(\'GPS tidak tersedia di browser ini\');return;}'
                    . 'navigator.geolocation.getCurrentPosition('
                    . '(pos)=>{'
                    . 'var url=\'https://maps.google.com/?q=\'+pos.coords.latitude+\',\'+pos.coords.longitude;'
                    . '$wire.set(\'data.urlmap\',url);},'
                    . '(err)=>{'
                    . 'if(err.message&&err.message.toLowerCase().includes(\'secure\')){'
                    . 'alert(\'GPS membutuhkan HTTPS.\\nBuka via https://qurban2026.test dari HP yang terhubung jaringan yang sama.\');'
                    . '}else if(err.code===1){'
                    . 'alert(\'Izin lokasi ditolak. Berikan izin GPS di pengaturan browser.\');'
                    . '}else{'
                    . 'alert(\'Gagal mendapatkan lokasi. Coba lagi atau isi URL manual.\');}},'
                    . '{enableHighAccuracy:true,timeout:10000})"'
                    . '>'
                    . '📍 Ambil Lokasi GPS (dari HP)</span>'
                ))
                ->helperText('Isi link Google Maps lokasi rumah sohibul. Buka dari HP untuk ambil GPS otomatis.'),

            // ── Keterangan ─────────────────────────────────────
            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(2)
                ->nullable(),
        ]);
    }

    // ── Table (dipakai di custom pages) ──────────────────────────
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_sohibul')->label('No. Sohibul')->sortable()->searchable(),
                TextColumn::make('noinvoice')
                    ->label('No. Invoice')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—')
                    ->copyable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
                TextColumn::make('jenis')->label('Jenis')->badge()->sortable(),
                TextColumn::make('nilaisepertuju')->label('Nilai (Rp)')->money('IDR')->sortable(),
                TextColumn::make('posisidana')->label('Posisi Dana')->badge(),
                TextColumn::make('bagiansohibul')->label('Bagian')->badge(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => SohibulSapi::STATUS_LABEL[$state] ?? '-')
                    ->color(fn ($state) => SohibulSapi::STATUS_COLOR[$state] ?? 'gray'),
            ])
            ->defaultSort('no_sohibul')
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListSohibulSapiReguler::route('/'),
            'create'  => Pages\CreateSohibulSapi::route('/create'),
            // Halaman list spesifik — harus SEBELUM /{record}
            'reguler' => Pages\ListSohibulSapiReguler::route('/reguler'),
            'super'   => Pages\ListSohibulSapiSuper::route('/super'),
            'duper'   => Pages\ListSohibulSapiDuper::route('/duper'),
            'pribadi' => Pages\ListSohibulSapiPribadi::route('/pribadi'),
            'rw9'     => Pages\ListSohibulSapiRW9::route('/rw9'),
            'rw10'    => Pages\ListSohibulSapiRW10::route('/rw10'),
            'rw11'    => Pages\ListSohibulSapiRW11::route('/rw11'),
            'rw12'    => Pages\ListSohibulSapiRW12::route('/rw12'),
            'luar'    => Pages\ListSohibulSapiLuar::route('/luar'),
            'kas'     => Pages\ListSohibulSapiKas::route('/kas'),
            'rek_program' => Pages\ListSohibulSapiRekProgram::route('/rek-program'),
            'rek_qurban'  => Pages\ListSohibulSapiRekQurban::route('/rek-qurban'),
            // Wildcard routes — HARUS di akhir
            'view'    => Pages\ViewSohibulSapi::route('/{record}'),
            'edit'    => Pages\EditSohibulSapi::route('/{record}/edit'),
        ];
    }
}
