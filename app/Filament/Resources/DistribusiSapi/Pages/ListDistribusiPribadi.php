<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiPribadi extends BaseListDistribusi
{
    protected ?string $filterJenis = 'PRIBADI';
    public static function getNavigationLabel(): string { return 'PRIBADI'; }
    public function getTitle(): string { return 'Distribusi — Sapi Pribadi'; }
    public static function getNavigationSort(): ?int { return 5; }
}
