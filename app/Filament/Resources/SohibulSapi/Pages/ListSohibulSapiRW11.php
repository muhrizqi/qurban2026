<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiRW11 extends BaseListSohibulSapi
{
    protected ?string $filterRw   = '11';
    protected string  $jenisLabel = 'Sohibul';
    public static function getNavigationLabel(): string { return 'RW 11'; }
    public function getTitle(): string { return 'Sohibul Sapi RW 11'; }
    public static function getNavigationSort(): ?int { return 7; }
}
