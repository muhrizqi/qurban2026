<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiDuper extends BaseListSohibulSapi
{
    protected ?string $filterJenis = 'DUPER';
    protected string  $jenisLabel  = 'Duper';
    public static function getNavigationLabel(): string { return 'DUPER'; }
    public function getTitle(): string { return 'Sohibul Sapi Duper'; }
    public static function getNavigationSort(): ?int { return 3; }
}
