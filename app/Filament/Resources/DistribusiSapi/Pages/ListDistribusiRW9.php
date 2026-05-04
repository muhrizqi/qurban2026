<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiRW9 extends BaseListDistribusi
{
    protected ?string $filterRw = '9';
    public static function getNavigationLabel(): string { return 'RW 9'; }
    public function getTitle(): string { return 'Distribusi — RW 9'; }
    public static function getNavigationSort(): ?int { return 6; }
}
