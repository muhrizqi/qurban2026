<?php
namespace App\Filament\Resources\SohibulSapi\Pages;

class ListSohibulSapiTidakDiambil extends BaseListSohibulSapi
{
    protected ?string $filterBagian = 'tidak_diambil';
    protected string  $jenisLabel   = 'Tidak Diambil';

    public static function getNavigationLabel(): string { return '🚫 Tidak Diambil'; }
    public function getTitle(): string { return 'Sohibul Sapi — Tidak Diambil'; }
    public static function getNavigationSort(): ?int { return 99; }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole([
            'admin', 'bendaharasapi', 'adminsohibul',
            'distribusisapi', 'adminsapi', 'petugasmap',
        ]);
    }
}
