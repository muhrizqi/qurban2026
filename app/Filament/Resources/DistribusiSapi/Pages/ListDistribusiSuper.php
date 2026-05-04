<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiSuper extends BaseListDistribusi
{
    protected ?string $filterJenis = 'SUPER';
    public static function getNavigationLabel(): string { return 'SUPER'; }
    public function getTitle(): string { return 'Distribusi — Sapi Super'; }
    public static function getNavigationSort(): ?int { return 3; }
}
