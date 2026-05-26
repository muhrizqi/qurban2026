<?php

namespace App\Filament\Pages;

use App\Models\ProgressState;
use App\Models\ProgressLog;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ProgressAdmin extends Page
{
    public static function getNavigationIcon(): ?string { return 'heroicon-o-presentation-chart-line'; }
    public static function getNavigationLabel(): string { return 'Monitor Progress'; }
    public function getTitle(): \Illuminate\Contracts\Support\Htmlable|string { return 'Progress Report Qurban'; }
    protected static ?string $slug = 'progress-admin';
    public static function shouldRegisterNavigation(array $parameters = []): bool { return false; }

    protected string $view = 'filament.pages.progress-admin';

    // Form variables
    public $theme;
    public $penyembelihan_sapi_tersembelih;
    public $penyembelihan_sapi_total;
    public $penyembelihan_kambing_tersembelih;
    public $penyembelihan_kambing_total;

    public $pengeletan_sapi_terkelet;
    public $pengeletan_sapi_total;
    public $pengeletan_kambing_terkelet;
    public $pengeletan_kambing_total;

    public $penimbangan_sapi_reguler_tertimbang;
    public $penimbangan_sapi_reguler_total;
    public $penimbangan_sapi_khusus_tertimbang;
    public $penimbangan_sapi_khusus_total;
    public $penimbangan_kambing_tertimbang;
    public $penimbangan_kambing_total;

    public $sohibul_sapi_reguler_terbungkus;
    public $sohibul_sapi_reguler_total;
    public $sohibul_sapi_reguler_tidak_diambil;
    public $sohibul_sapi_reguler_terdistribusi;

    public $sohibul_sapi_khusus_terbungkus;
    public $sohibul_sapi_khusus_total;
    public $sohibul_sapi_khusus_tidak_diambil;
    public $sohibul_sapi_khusus_terdistribusi;

    public $sohibul_kambing_terbungkus;
    public $sohibul_kambing_total;
    public $sohibul_kambing_terdistribusi;

    public $bungkusan_daging_terbungkus;
    public $bungkusan_daging_total;
    public $bungkusan_daging_terdistribusi;

    // Theme variables
    public $color_block_1;
    public $color_block_2;
    public $color_block_3;
    public $color_block_4;
    public $color_block_5;
    public $color_block_6;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminprogres']) ?? false;
    }

    public function mount()
    {
        $state = ProgressState::getSingle();
        $this->fill($state->toArray());
    }

    /**
     * Increment a state variable.
     */
    public function increment($field)
    {
        $this->$field = (int) $this->$field + 1;
        $this->saveField($field);
    }

    /**
     * Decrement a state variable.
     */
    public function decrement($field)
    {
        $this->$field = max(0, (int) $this->$field - 1);
        $this->saveField($field);
    }

    /**
     * Livewire updated hook to save value immediately when user types in the input.
     */
    public function updated($propertyName)
    {
        $this->saveField($propertyName);
    }

    /**
     * Internal helper to persist a specific field to the database.
     */
    protected function saveField($field)
    {
        $state = ProgressState::getSingle();
        $state->$field = $this->$field;

        // Auto-update timestamps for modified fields
        $timeField = $this->getTimeFieldForProperty($field);
        if ($timeField) {
            $state->$timeField = now();
        }

        $state->save();
    }

    /**
     * Map a progress variable to its corresponding updated timestamp.
     */
    protected function getTimeFieldForProperty($property)
    {
        $mappings = [
            'penyembelihan_sapi_tersembelih' => 'penyembelihan_sapi_time',
            'penyembelihan_sapi_total' => 'penyembelihan_sapi_time',
            'penyembelihan_kambing_tersembelih' => 'penyembelihan_kambing_time',
            'penyembelihan_kambing_total' => 'penyembelihan_kambing_time',
            
            'pengeletan_sapi_terkelet' => 'pengeletan_sapi_time',
            'pengeletan_sapi_total' => 'pengeletan_sapi_time',
            'pengeletan_kambing_terkelet' => 'pengeletan_kambing_time',
            'pengeletan_kambing_total' => 'pengeletan_kambing_time',
            
            'penimbangan_sapi_reguler_tertimbang' => 'penimbangan_sapi_reguler_time',
            'penimbangan_sapi_reguler_total' => 'penimbangan_sapi_reguler_time',
            'penimbangan_sapi_khusus_tertimbang' => 'penimbangan_sapi_khusus_time',
            'penimbangan_sapi_khusus_total' => 'penimbangan_sapi_khusus_time',
            'penimbangan_kambing_tertimbang' => 'penimbangan_kambing_time',
            'penimbangan_kambing_total' => 'penimbangan_kambing_time',
            
            'sohibul_sapi_reguler_terbungkus' => 'sohibul_sapi_reguler_terbungkus_time',
            'sohibul_sapi_reguler_terdistribusi' => 'sohibul_sapi_reguler_terdistribusi_time',
            'sohibul_sapi_khusus_terbungkus' => 'sohibul_sapi_khusus_terbungkus_time',
            'sohibul_sapi_khusus_terdistribusi' => 'sohibul_sapi_khusus_terdistribusi_time',
            
            'sohibul_kambing_terbungkus' => 'sohibul_kambing_terbungkus_time',
            'sohibul_kambing_terdistribusi' => 'sohibul_kambing_terdistribusi_time',
            
            'bungkusan_daging_terbungkus' => 'bungkusan_daging_terbungkus_time',
            'bungkusan_daging_terdistribusi' => 'bungkusan_daging_terdistribusi_time',
        ];

        return $mappings[$property] ?? null;
    }

    /**
     * Action to pull Block 4 data directly from the sohibul_sapi table.
     */
    public function updateBlock4FromDatabase()
    {
        $state = ProgressState::getSingle();
        
        // 1. Sapi Reguler
        $state->sohibul_sapi_reguler_total = \App\Models\SohibulSapi::where('jenis', 'REGULER')->count();
        $state->sohibul_sapi_reguler_tidak_diambil = \App\Models\SohibulSapi::where('jenis', 'REGULER')->where('bagiansohibul', 'tidak_diambil')->count();
        $state->sohibul_sapi_reguler_terdistribusi = \App\Models\SohibulSapi::where('jenis', 'REGULER')->where('status', 2)->count();
        
        // 2. Sapi Khusus (Super, Duper, Pribadi)
        $state->sohibul_sapi_khusus_total = \App\Models\SohibulSapi::whereIn('jenis', ['SUPER', 'DUPER', 'PRIBADI'])->count();
        $state->sohibul_sapi_khusus_tidak_diambil = \App\Models\SohibulSapi::whereIn('jenis', ['SUPER', 'DUPER', 'PRIBADI'])->where('bagiansohibul', 'tidak_diambil')->count();
        $state->sohibul_sapi_khusus_terdistribusi = \App\Models\SohibulSapi::whereIn('jenis', ['SUPER', 'DUPER', 'PRIBADI'])->where('status', 2)->count();
        
        // Update timestamps
        $state->sohibul_sapi_reguler_terdistribusi_time = now();
        $state->sohibul_sapi_khusus_terdistribusi_time = now();
        
        $state->save();
        
        // Reload page state properties
        $this->mount();
        
        Notification::make()
            ->title('Statistik Sohibul Sapi berhasil disinkronkan dari database!')
            ->success()
            ->send();
    }

    /**
     * Clear all recorded progress log history entries.
     */
    public function clearLogs()
    {
        ProgressLog::truncate();
        
        Notification::make()
            ->title('Seluruh log aktivitas progress berhasil dihapus!')
            ->success()
            ->send();
    }

    /**
     * Define header actions.
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('clearLogs')
                ->label('Hapus Semua Log')
                ->color('danger')
                ->icon('heroicon-m-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Semua Log Aktivitas?')
                ->modalDescription('Apakah Anda yakin ingin menghapus semua data log? Semua data animasi playback dari awal akan hilang.')
                ->modalSubmitActionLabel('Ya, Hapus Semua')
                ->action(fn () => $this->clearLogs()),
        ];
    }
}
