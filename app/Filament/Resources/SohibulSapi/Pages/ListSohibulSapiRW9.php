<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiRW9 extends BaseListSohibulSapi
{
    protected ?string $filterRw   = '9';
    protected string  $jenisLabel = 'Sohibul';
    public static function getNavigationLabel(): string { return 'RW 9'; }
    public function getTitle(): string { return 'Sohibul Sapi RW 9'; }
    public static function getNavigationSort(): ?int { return 5; }
}
