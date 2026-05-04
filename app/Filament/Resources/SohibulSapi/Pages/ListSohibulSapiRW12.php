<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiRW12 extends BaseListSohibulSapi
{
    protected ?string $filterRw   = '12';
    protected string  $jenisLabel = 'Sohibul';
    public static function getNavigationLabel(): string { return 'RW 12'; }
    public function getTitle(): string { return 'Sohibul Sapi RW 12'; }
    public static function getNavigationSort(): ?int { return 8; }
}
