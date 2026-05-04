<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DistribusiStatsWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']) ?? false;
    }
    protected static ?int $sort = -1;

    // Dikirim dari page via getWidgetData()
    public ?string $filterJenis = null;
    public ?string $filterRw    = null;
    public bool    $filterLuar  = false;

    protected function getStats(): array
    {
        // Base query dengan filter dari halaman pemanggil
        $base = SohibulSapi::query()
            ->when($this->filterJenis, fn ($q) => $q->where('jenis', $this->filterJenis))
            ->when($this->filterRw,    fn ($q) => $q->where('rw',    $this->filterRw))
            ->when($this->filterLuar,  fn ($q) => $q->where('rt',    'non_warga'));

        $total         = (clone $base)->count();
        $sudahDiantar  = (clone $base)->where('status', 2)->count();
        $sedangDiantar = (clone $base)->where('status', 1)->count();
        $tidakDiambil  = (clone $base)->where('bagiansohibul', 'tidak_diambil')->count();
        $belumDiproses = (clone $base)->where('status', 0)
                            ->where('bagiansohibul', '!=', 'tidak_diambil')
                            ->count();

        $pctSelesai = $total > 0 ? round(($sudahDiantar / $total) * 100, 1) : 0;

        // Label konteks (ditampilkan sebagai deskripsi)
        $konteks = match(true) {
            (bool) $this->filterJenis => 'Jenis: ' . $this->filterJenis,
            (bool) $this->filterRw   => 'RW ' . $this->filterRw,
            $this->filterLuar        => 'Luar Jogokariyan',
            default                  => 'Semua data',
        };

        return [
            Stat::make('✅ Sudah Diantar', $sudahDiantar)
                ->description("{$pctSelesai}% dari {$konteks}")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('🚚 Sedang Diantar', $sedangDiantar)
                ->description('Dalam proses pengiriman')
                ->descriptionIcon('heroicon-m-truck')
                ->color('warning'),

            Stat::make('🏠 Tidak Diambil', $tidakDiambil)
                ->description('Diambil sendiri / tidak perlu antar')
                ->descriptionIcon('heroicon-m-home')
                ->color('gray'),

            Stat::make('⏳ Belum Diproses', $belumDiproses)
                ->description('Perlu segera diantarkan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),

            Stat::make('📦 Total', $total)
                ->description($konteks)
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
