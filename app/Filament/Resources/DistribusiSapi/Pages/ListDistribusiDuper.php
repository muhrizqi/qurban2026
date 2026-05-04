<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiDuper extends BaseListDistribusi
{
    protected ?string $filterJenis = 'DUPER';
    public static function getNavigationLabel(): string { return 'DUPER'; }
    public function getTitle(): string { return 'Distribusi — Sapi Duper'; }
    public static function getNavigationSort(): ?int { return 4; }
}
