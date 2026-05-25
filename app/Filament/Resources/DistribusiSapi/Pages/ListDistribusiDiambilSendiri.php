<?php

namespace App\Filament\Resources\DistribusiSapi\Pages;

class ListDistribusiDiambilSendiri extends BaseListDistribusi
{
    protected ?string $filterBagian = 'diambil_sendiri';

    public static function getNavigationLabel(): string { return 'Diambil Sendiri'; }
    public function getTitle(): string { return 'Distribusi Sapi — Diambil Sendiri'; }
    public static function getNavigationSort(): ?int { return 12; }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole([
            'admin', 'bendaharasapi', 'adminsohibul',
            'distribusisapi', 'adminsapi', 'petugasmap',
        ]);
    }
}
