<?php
namespace App\Filament\Resources\DistribusiSapi\Pages;
class ListDistribusiReguler extends BaseListDistribusi
{
    protected ?string $filterJenis = 'REGULER';
    public static function getNavigationLabel(): string { return 'REGULER'; }
    public function getTitle(): string { return 'Distribusi — Sapi Reguler'; }
    public static function getNavigationSort(): ?int { return 2; }
}
