<?php

namespace App\Providers\Filament;

use App\Filament\Pages\DataOnlinePage;
use App\Filament\Pages\PetaSohibulPage;
use App\Filament\Pages\BackupPage;
use App\Filament\Resources\SohibulSapi\SohibulSapiResource;
use App\Filament\Resources\DistribusiSapi\DistribusiSapiResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
                DataOnlinePage::class,
                PetaSohibulPage::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->navigationItems($this->buildNavigationItems())
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    private function buildNavigationItems(): array
    {
        $sohibulMenus = [
            ['key' => 'reguler', 'label' => 'REGULER', 'sort' => 1],
            ['key' => 'super',   'label' => 'SUPER',   'sort' => 2],
            ['key' => 'duper',   'label' => 'DUPER',   'sort' => 3],
            ['key' => 'pribadi', 'label' => 'PRIBADI', 'sort' => 4],
            ['key' => 'rw9',     'label' => 'RW 9',    'sort' => 5, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap']],
            ['key' => 'rw10',    'label' => 'RW 10',   'sort' => 6, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap']],
            ['key' => 'rw11',    'label' => 'RW 11',   'sort' => 7, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap']],
            ['key' => 'rw12',    'label' => 'RW 12',   'sort' => 8, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap']],
            ['key' => 'luar',    'label' => 'JAMAAH LUAR', 'sort' => 9, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap']],
            ['key' => 'kas',     'label' => 'KAS',         'sort' => 10, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi']],
            ['key' => 'rek_program', 'label' => 'REK. PROGRAM', 'sort' => 11, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi']],
            ['key' => 'rek_qurban',  'label' => 'REK. QURBAN',  'sort' => 12, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi']],
        ];

        $distribusiMenus = [
            ['key' => 'tugas',   'label' => 'TUGAS',   'sort' => 1],
            ['key' => 'reguler', 'label' => 'REGULER', 'sort' => 2],
            ['key' => 'super',   'label' => 'SUPER',   'sort' => 3],
            ['key' => 'duper',   'label' => 'DUPER',   'sort' => 4],
            ['key' => 'pribadi', 'label' => 'PRIBADI', 'sort' => 5],
            ['key' => 'rw9',     'label' => 'RW 9',    'sort' => 6],
            ['key' => 'rw10',    'label' => 'RW 10',   'sort' => 7],
            ['key' => 'rw11',    'label' => 'RW 11',   'sort' => 8],
            ['key' => 'rw12',    'label' => 'RW 12',   'sort' => 9],
            ['key' => 'luar',    'label' => 'JAMAAH LUAR', 'sort' => 10],
            ['key' => 'tidak_diambil',   'label' => '🚫 TIDAK DIAMBIL',   'sort' => 11, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap', 'distribusisapi', 'adminsapi']],
            ['key' => 'diambil_sendiri', 'label' => '🏠 DIAMBIL SENDIRI', 'sort' => 12, 'roles' => ['admin', 'adminsohibul', 'bendaharasapi', 'petugasmap', 'distribusisapi', 'adminsapi']],
        ];

        $items = [];

        // ── Group "Sohibul Sapi" untuk admin, adminsohibul & bendaharasapi ─────
        foreach ($sohibulMenus as $menu) {
            $items[] = NavigationItem::make($menu['label'])
                ->group('Sohibul Sapi')
                ->sort($menu['sort'])
                ->icon('heroicon-o-list-bullet')
                ->url(fn () => SohibulSapiResource::getUrl($menu['key']))
                ->isActiveWhen(fn () => request()->url() === SohibulSapiResource::getUrl($menu['key']))
                ->visible(fn () => auth()->user()?->hasAnyRole($menu['roles'] ?? ['admin', 'adminsohibul', 'bendaharasapi']));
        }

        // ── Group "Distribusi Sapi" untuk adminsapi & distribusisapi ─
        foreach ($distribusiMenus as $menu) {
            $items[] = NavigationItem::make($menu['label'])
                ->group('Distribusi Sapi')
                ->sort($menu['sort'])
                ->icon($menu['key'] === 'tugas' ? 'heroicon-o-clipboard-document-list' : 'heroicon-o-list-bullet')
                ->url(fn () => DistribusiSapiResource::getUrl($menu['key']))
                ->isActiveWhen(fn () => request()->url() === DistribusiSapiResource::getUrl($menu['key']))
                ->visible(fn () => auth()->user()?->hasAnyRole($menu['roles'] ?? ['adminsapi', 'distribusisapi']));
        }

        // ── Peta Sohibul — navigasi manual agar muncul di grup Distribusi Sapi ─
        $items[] = NavigationItem::make('🗺️ PETA SOHIBUL')
            ->group('Distribusi Sapi')
            ->sort(11)
            ->icon('heroicon-o-map')
            ->url(fn () => PetaSohibulPage::getUrl())
            ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.peta-sohibul'))
            ->visible(fn () => auth()->user()?->hasAnyRole(['admin', 'adminsohibul', 'bendaharasapi', 'adminsapi', 'distribusisapi', 'petugasmap']));

        // ── Backup & Restore (Khusus Admin) ──────────────────────────
        $items[] = NavigationItem::make('💾 BACKUP & RESTORE')
            ->group('Sistem')
            ->sort(100)
            ->icon('heroicon-o-cloud-arrow-down')
            ->url(fn () => BackupPage::getUrl())
            ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.backup-page'))
            ->visible(fn () => auth()->user()?->hasRole('admin'));

        return $items;
    }
}
