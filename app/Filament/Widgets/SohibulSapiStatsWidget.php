<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SohibulSapiStatsWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'adminsohibul', 'bendaharasapi']) ?? false;
    }

    protected function getStats(): array
    {
        $total    = SohibulSapi::count();
        $reguler  = SohibulSapi::where('jenis', 'REGULER')->count();
        $super    = SohibulSapi::where('jenis', 'SUPER')->count();
        $duper    = SohibulSapi::where('jenis', 'DUPER')->count();
        $pribadi  = SohibulSapi::where('jenis', 'PRIBADI')->count();

        // Total nominal terkumpul
        $nominal  = SohibulSapi::sum('nilaisepertuju');

        return [
            Stat::make('🐄 Total Sohibul', number_format($total))
                ->description('Semua jenis')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('REGULER', number_format($reguler))
                ->description('Rp ' . number_format(SohibulSapi::NILAI_DEFAULT['REGULER'], 0, ',', '.') . ' / orang')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make('SUPER', number_format($super))
                ->description('Rp ' . number_format(SohibulSapi::NILAI_DEFAULT['SUPER'], 0, ',', '.') . ' / orang')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('DUPER', number_format($duper))
                ->description('Rp ' . number_format(SohibulSapi::NILAI_DEFAULT['DUPER'], 0, ',', '.') . ' / orang')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),

            Stat::make('PRIBADI', number_format($pribadi))
                ->description('Nominal bervariasi')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('💰 Total Nominal', 'Rp ' . number_format($nominal, 0, ',', '.'))
                ->description('Estimasi dari semua sohibul')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
