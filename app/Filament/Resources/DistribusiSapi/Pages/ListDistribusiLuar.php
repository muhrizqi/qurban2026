<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiLuar extends BaseListDistribusi
{
    protected bool $filterLuar = true;
    public static function getNavigationLabel(): string { return 'JAMAAH LUAR'; }
    public function getTitle(): string { return 'Distribusi — Jamaah Luar Jogokariyan'; }
    public static function getNavigationSort(): ?int { return 10; }
}
