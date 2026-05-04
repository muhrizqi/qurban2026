<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiRW11 extends BaseListDistribusi
{
    protected ?string $filterRw = '11';
    public static function getNavigationLabel(): string { return 'RW 11'; }
    public function getTitle(): string { return 'Distribusi — RW 11'; }
    public static function getNavigationSort(): ?int { return 8; }
}
