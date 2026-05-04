<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiLuar extends BaseListSohibulSapi
{
    protected bool   $filterLuar = true;
    protected string $jenisLabel = 'Jamaah Luar';
    public static function getNavigationLabel(): string { return 'JAMAAH LUAR'; }
    public function getTitle(): string { return 'Sohibul — Jamaah Luar Jogokariyan'; }
    public static function getNavigationSort(): ?int { return 9; }
}
