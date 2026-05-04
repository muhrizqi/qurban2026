<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiRW12 extends BaseListDistribusi
{
    protected ?string $filterRw = '12';
    public static function getNavigationLabel(): string { return 'RW 12'; }
    public function getTitle(): string { return 'Distribusi — RW 12'; }
    public static function getNavigationSort(): ?int { return 9; }
}
