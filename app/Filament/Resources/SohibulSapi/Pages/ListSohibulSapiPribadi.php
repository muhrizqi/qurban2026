<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiPribadi extends BaseListSohibulSapi
{
    protected ?string $filterJenis = 'PRIBADI';
    protected string  $jenisLabel  = 'Pribadi';
    public static function getNavigationLabel(): string { return 'PRIBADI'; }
    public function getTitle(): string { return 'Sohibul Sapi Pribadi'; }
    public static function getNavigationSort(): ?int { return 4; }
}
