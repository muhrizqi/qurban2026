<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiRW10 extends BaseListSohibulSapi
{
    protected ?string $filterRw   = '10';
    protected string  $jenisLabel = 'Sohibul';
    public static function getNavigationLabel(): string { return 'RW 10'; }
    public function getTitle(): string { return 'Sohibul Sapi RW 10'; }
    public static function getNavigationSort(): ?int { return 6; }
}
