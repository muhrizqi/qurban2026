<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DanaBendaharaWidget extends BaseWidget
{
    protected static bool $isDiscovered = true;
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['bendaharasapi']) ?? false;
    }

    protected function getStats(): array
    {
        // Total nilaisepertuju per posisi dana
        $kas     = SohibulSapi::where('posisidana', 'Kas')->sum('nilaisepertuju');
        $rekProg = SohibulSapi::where('posisidana', 'Rek Program')->sum('nilaisepertuju');
        $rekQurb = SohibulSapi::where('posisidana', 'Rek Qurban')->sum('nilaisepertuju');
        $total   = $kas + $rekProg + $rekQurb;

        // Breakdown helper
        $getBreakdown = function ($posisi) {
            $r = SohibulSapi::where('posisidana', $posisi)->where('jenis', 'REGULER')->count();
            $s = SohibulSapi::where('posisidana', $posisi)->where('jenis', 'SUPER')->count();
            $d = SohibulSapi::where('posisidana', $posisi)->where('jenis', 'DUPER')->count();
            $p = SohibulSapi::where('posisidana', $posisi)->where('jenis', 'PRIBADI')->count();
            return "R: $r, S: $s, D: $d, P: $p";
        };

        return [
            Stat::make('🏦 Total Dana Terkumpul', 'Rp ' . number_format($total, 0, ',', '.'))
                ->description('Dari semua posisi dana')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('success'),

            Stat::make('💵 Kas', 'Rp ' . number_format($kas, 0, ',', '.'))
                ->description($getBreakdown('Kas'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('🏧 Rek. Program', 'Rp ' . number_format($rekProg, 0, ',', '.'))
                ->description($getBreakdown('Rek Program'))
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('info'),

            Stat::make('🏦 Rek. Qurban', 'Rp ' . number_format($rekQurb, 0, ',', '.'))
                ->description($getBreakdown('Rek Qurban'))
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('primary'),
        ];
    }
}
