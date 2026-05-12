<?php

namespace App\Filament\Resources\DistribusiSapi\Pages;

class ListDistribusiTidakDiambil extends BaseListDistribusi
{
    protected ?string $filterBagian = 'tidak_diambil';

    public function getTitle(): string { return 'Distribusi Sapi — Tidak Diambil'; }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole([
            'admin', 'bendaharasapi', 'adminsohibul',
            'distribusisapi', 'adminsapi', 'petugasmap',
        ]);
    }
}
