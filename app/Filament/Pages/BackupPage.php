<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cloud-arrow-down';
    protected static ?string $navigationLabel = 'Backup & Restore';
    protected static ?string $title = 'Backup & Restore';
    protected static string | \UnitEnum | null $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Restore Data')
                    ->description('Unggah file backup (.zip) untuk memulihkan database dan file kwitansi. PERHATIAN: Ini akan menimpa data yang ada saat ini.')
                    ->schema([
                        FileUpload::make('backup_file')
                            ->label('File Backup (.zip)')
                            ->required()
                            ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed'])
                            ->disk('local')
                            ->directory('temp-backups')
                            ->visibility('private')
                            ->preserveFilenames(),
                    ])
            ])
            ->statePath('data');
    }

    /**
     * Jalankan proses backup dan download menggunakan spatie/laravel-backup
     */
    public function downloadBackup()
    {
        try {
            // Jalankan perintah backup
            \Illuminate\Support\Facades\Artisan::call('backup:run', ['--only-to-disk' => 'local']);

            $disk = \Illuminate\Support\Facades\Storage::disk('local');
            $appName = config('backup.backup.name');
            
            // Ambil semua file dalam folder aplikasi di disk lokal
            $files = $disk->files($appName);
            
            if (empty($files)) {
                Notification::make()->title('File backup tidak ditemukan di disk')->danger()->send();
                return;
            }

            // Urutkan berdasarkan waktu modifikasi terbaru
            usort($files, fn($a, $b) => $disk->lastModified($b) <=> $disk->lastModified($a));
            $latestBackup = $disk->path($files[0]);

            return response()->download($latestBackup);

        } catch (\Exception $e) {
            Notification::make()
                ->title('Terjadi Kesalahan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Jalankan proses restore (Kompatibel dengan struktur spatie/laravel-backup)
     */
    public function restoreBackup()
    {
        $state = $this->form->getState();
        $fileName = $state['backup_file'];
        
        $disk = \Illuminate\Support\Facades\Storage::disk('local');
        $filePath = $disk->path($fileName);

        if (!$disk->exists($fileName)) {
            Notification::make()->title('File tidak ditemukan')->danger()->send();
            return;
        }

        $zip = new ZipArchive();
        if ($zip->open($filePath) === TRUE) {
            
            $tempPath = storage_path('app/temp-restore-' . uniqid());
            File::makeDirectory($tempPath);

            // 1. Restore Database
            $dbConn = config('database.default');
            
            if ($dbConn === 'sqlite') {
                // Cari database.sqlite di dalam zip (bisa di root atau di folder database/)
                $dbInsidePath = null;
                if ($zip->locateName('database.sqlite') !== false) {
                    $dbInsidePath = 'database.sqlite';
                } elseif ($zip->locateName('database/database.sqlite') !== false) {
                    $dbInsidePath = 'database/database.sqlite';
                }

                if ($dbInsidePath) {
                    $zip->extractTo($tempPath, $dbInsidePath);
                    File::copy(database_path('database.sqlite'), database_path('database.sqlite.bak'));
                    File::move($tempPath . '/' . $dbInsidePath, database_path('database.sqlite'));
                }
            } elseif (in_array($dbConn, ['mysql', 'pgsql'])) {
                // Untuk MySQL atau PostgreSQL, cari file .sql di dalam folder db-dumps/
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $name = $zip->getNameIndex($i);
                    if (str_starts_with($name, 'db-dumps/') && str_ends_with($name, '.sql')) {
                        $zip->extractTo($tempPath, $name);
                        $sqlContent = File::get($tempPath . '/' . $name);
                        
                        // Jalankan SQL dump ke database aktif
                        \Illuminate\Support\Facades\DB::unprepared($sqlContent);
                    }
                }
            }

            // 2. Restore Kwitansi
            // Cari file yang mengandung 'kwitansi/' dalam path-nya
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name = $zip->getNameIndex($i);
                if (str_contains($name, 'kwitansi/')) {
                    // Kita ekstrak ke public/storage, tapi kita perlu memotong path awal jika ada
                    // Contoh: public/storage/kwitansi/file.jpg -> kwitansi/file.jpg
                    $zip->extractTo(public_path('storage'), $name);
                }
            }

            $zip->close();
            File::deleteDirectory($tempPath);
            File::delete($filePath);

            Notification::make()
                ->title('Restore Berhasil')
                ->body('Data telah dipulihkan. Jika menggunakan SQLite, database lama dicadangkan sebagai .bak')
                ->success()
                ->persistent()
                ->send();
            
            $this->data = [];
        } else {
            Notification::make()->title('Gagal membuka file zip')->danger()->send();
        }
    }

    public function getView(): string
    {
        return 'filament.pages.backup-page';
    }
}
