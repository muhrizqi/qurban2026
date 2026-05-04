<?php

namespace App\Filament\Pages;

use App\Models\SohibulSapi;
use Filament\Pages\Page;

class PetaSohibulPage extends Page
{
    public function getView(): string { return 'filament.pages.peta-sohibul'; }

    // ── Navigasi ─────────────────────────────────────────────────
    public static function getNavigationLabel(): string { return '🗺️ Peta Sohibul'; }
    public static function getNavigationIcon(): string  { return 'heroicon-o-map'; }
    public static function getNavigationSort(): ?int    { return 50; }
    public static function getNavigationGroup(): ?string { return 'Distribusi Sapi'; }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasAnyRole(['adminsapi', 'distribusisapi']);
    }

    public function getTitle(): string { return 'Peta Posisi Sohibul Sapi'; }

    // ── Data untuk view ───────────────────────────────────────────
    public function getMarkers(): array
    {
        return SohibulSapi::query()
            ->whereNotNull('urlmap')
            ->where('urlmap', '!=', '')
            ->get()
            ->map(function (SohibulSapi $s): ?array {
                $coords = $this->extractCoords($s->urlmap);
                if (! $coords) return null;

                return [
                    'id'       => $s->id,
                    'lat'      => $coords['lat'],
                    'lng'      => $coords['lng'],
                    'nama'     => $s->nama,
                    'no'       => $s->no_sohibul,
                    'jenis'    => $s->jenis,
                    'rt'       => $s->rt,
                    'rw'       => $s->rw,
                    'alamat'   => $s->alamat,
                    'nohp'     => $s->nohp,
                    'bagian'   => SohibulSapi::BAGIAN_OPTIONS[$s->bagiansohibul] ?? $s->bagiansohibul,
                    'status'   => (int) $s->status,
                    'statusLabel' => SohibulSapi::STATUS_LABEL[$s->status] ?? '-',
                    'urlmap'   => $s->urlmap,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Ekstrak lat,lng dari berbagai format URL Google Maps.
     */
    private function extractCoords(string $url): ?array
    {
        // Format: ?q=lat,lng  atau  @lat,lng
        if (preg_match('/[?&]q=(-?\d+\.?\d*),(-?\d+\.?\d*)/', $url, $m)) {
            return ['lat' => (float)$m[1], 'lng' => (float)$m[2]];
        }
        if (preg_match('/@(-?\d+\.?\d*),(-?\d+\.?\d*)/', $url, $m)) {
            return ['lat' => (float)$m[1], 'lng' => (float)$m[2]];
        }
        // Format: /maps/place/.../@lat,lng,zoom
        if (preg_match('/maps\/place\/[^@]*@(-?\d+\.?\d*),(-?\d+\.?\d*)/', $url, $m)) {
            return ['lat' => (float)$m[1], 'lng' => (float)$m[2]];
        }
        // Format: ll=lat,lng
        if (preg_match('/ll=(-?\d+\.?\d*),(-?\d+\.?\d*)/', $url, $m)) {
            return ['lat' => (float)$m[1], 'lng' => (float)$m[2]];
        }
        return null;
    }

    public function getApiKey(): string
    {
        return env('GEOAPIFY_API_KEY', '');
    }

    public function getStats(): array
    {
        $all     = SohibulSapi::all();
        $total   = $all->count();
        $mapped  = SohibulSapi::whereNotNull('urlmap')->where('urlmap', '!=', '')->count();

        return [
            'total'   => $total,
            'mapped'  => $mapped,
            'belum'   => $all->where('status', 0)->count(),
            'proses'  => $all->where('status', 1)->count(),
            'selesai' => $all->where('status', 2)->count(),
        ];
    }
}
