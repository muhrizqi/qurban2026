<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiReguler extends BaseListSohibulSapi
{
    protected ?string $filterJenis = 'REGULER';
    protected string  $jenisLabel  = 'Reguler';
    public static function getNavigationLabel(): string { return 'REGULER'; }
    public function getTitle(): string { return 'Sohibul Sapi Reguler'; }
    public static function getNavigationSort(): ?int { return 1; }
}
