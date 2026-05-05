<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SohibulMapStatsWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminsohibul', 'petugasmap']) ?? false;
    }

    protected function getStats(): array
    {
        $total          = SohibulSapi::count();
        $sudahAdaMap    = SohibulSapi::whereNotNull('urlmap')->where('urlmap', '!=', '')->count();
        $tidakDiambil   = SohibulSapi::where('bagiansohibul', 'tidak_diambil')->count();
        $belumAdaMap    = SohibulSapi::where(function($q) {
                                $q->whereNull('urlmap')->orWhere('urlmap', '');
                            })
                            ->where('bagiansohibul', '!=', 'tidak_diambil')
                            ->count();

        return [
            Stat::make('📊 Total Sohibul', number_format($total))
                ->description('Seluruh data sohibul')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('📍 Sudah Ada Map', number_format($sudahAdaMap))
                ->description('Lokasi sudah terdata')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('🚫 Tidak Diambil', number_format($tidakDiambil))
                ->description('Daging tidak diambil')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('warning'),

            Stat::make('❓ Belum Ada Map', number_format($belumAdaMap))
                ->description('Menunggu pemetaan')
                ->descriptionIcon('heroicon-m-map')
                ->color('danger'),
        ];
    }
}
