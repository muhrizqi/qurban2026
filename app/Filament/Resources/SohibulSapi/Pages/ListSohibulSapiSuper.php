<?php
namespace App\Filament\Resources\SohibulSapi\Pages;
class ListSohibulSapiSuper extends BaseListSohibulSapi
{
    protected ?string $filterJenis = 'SUPER';
    protected string  $jenisLabel  = 'Super';
    public static function getNavigationLabel(): string { return 'SUPER'; }
    public function getTitle(): string { return 'Sohibul Sapi Super'; }
    public static function getNavigationSort(): ?int { return 2; }
}
