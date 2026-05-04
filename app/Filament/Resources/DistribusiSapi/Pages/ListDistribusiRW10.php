<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiRW10 extends BaseListDistribusi
{
    protected ?string $filterRw = '10';
    public static function getNavigationLabel(): string { return 'RW 10'; }
    public function getTitle(): string { return 'Distribusi — RW 10'; }
    public static function getNavigationSort(): ?int { return 7; }
}
