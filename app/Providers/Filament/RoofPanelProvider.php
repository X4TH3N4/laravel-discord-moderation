<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Roof\Pages\Auth\EditProfile;
use App\Filament\Roof\Resources\GuildResource;
use App\Http\Middleware\VerifyIsActivated;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use pxlrbt\FilamentEnvironmentIndicator\EnvironmentIndicatorPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class RoofPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('roof')
            ->path('roof')
            ->login()
            ->registration()
            ->profile(EditProfile::class)
            ->font('Poppins')
            ->favicon(asset('roof.jpeg'))
            ->discoverResources(in: app_path('Filament/Roof/Resources'), for: 'App\\Filament\\Roof\\Resources')
            ->discoverPages(in: app_path('Filament/Roof/Pages'), for: 'App\\Filament\\Roof\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Roof/Widgets'), for: 'App\\Filament\\Roof\\Widgets')
            ->widgets([
//                Widgets\AccountWidget::class,
//                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                SetTheme::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
//                FilamentSpatieRolesPermissionsPlugin::make(),
                SpotlightPlugin::make(),
                LightSwitchPlugin::make()->position(Alignment::TopCenter),
                FilamentProgressbarPlugin::make()->color('#FBBF24'),
                ThemesPlugin::make(),
//                FilamentSpatieLaravelHealthPlugin::make(),
                QuickCreatePlugin::make()->excludes((array)GuildResource::class),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenantMiddleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ]);
//            ->resources([
//                config('filament-logger.activity_resource')
//            ]);
    }
}