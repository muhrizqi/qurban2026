<?php

namespace App\Filament\Widgets;

use App\Models\SohibulSapi;
use Filament\Widgets\Widget;

class DistribusiStatsWidget extends Widget
{
    protected static bool $isDiscovered = true;
    protected static ?int $sort = -1;
    protected static string $view = 'filament.widgets.distribusi-stats-widget';
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']) ?? false;
    }

    // Dikirim dari page via getWidgetData()
    public ?string $filterJenis  = null;
    public ?string $filterRw     = null;
    public ?string $filterBagian = null;
    public bool    $filterLuar   = false;

    protected function getViewData(): array
    {
        $base = SohibulSapi::query()
            ->when($this->filterJenis,  fn ($q) => $q->where('jenis', $this->filterJenis))
            ->when($this->filterRw,     fn ($q) => $q->where('rw',    $this->filterRw))
            ->when($this->filterBagian, fn ($q) => $q->where('bagiansohibul', $this->filterBagian))
            ->when($this->filterLuar,   fn ($q) => $q->where('rt',    'non_warga'));

        $total          = (clone $base)->count();
        $sudahDiantar   = (clone $base)->where('status', 2)->count();
        $sedangDiantar  = (clone $base)->where('status', 1)->count();
        $tidakDiambil   = (clone $base)->where('bagiansohibul', 'tidak_diambil')->count();
        $diambilSendiri = (clone $base)->where('bagiansohibul', 'diambil_sendiri')->count();
        $belumDiproses  = (clone $base)->where('status', 0)
                            ->whereNotIn('bagiansohibul', ['tidak_diambil', 'diambil_sendiri'])
                            ->count();

        return compact(
            'total', 'sudahDiantar', 'sedangDiantar',
            'tidakDiambil', 'diambilSendiri', 'belumDiproses'
        );
    }
}
