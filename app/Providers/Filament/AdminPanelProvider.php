<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Admin\Resources\UserResource;
<<<<<<< HEAD
use App\Filament\Home\Pages\Auth\EditProfile;
use App\Filament\Home\Resources\GuildResource;
use App\Filament\Home\Widgets\CategoryChart;
use App\Filament\Home\Widgets\ChannelChart;
use App\Filament\Home\Widgets\RequestChart;
use App\Filament\Home\Widgets\UserChart;
=======
use App\Filament\Home\Pages\Auth\EditProfile;
use App\Filament\Home\Resources\GuildResource;
use App\Filament\Home\Widgets\CategoryChart;
use App\Filament\Home\Widgets\ChannelChart;
use App\Filament\Home\Widgets\RequestChart;
use App\Filament\Home\Widgets\UserChart;
>>>>>>> origin/main
use App\Http\Middleware\VerifyIsActivated;
use App\Http\Middleware\VerifyIsAdmin;
use App\Models\Setting;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
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
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login(Pages\Auth\Login::class)
            ->registration(Pages\Auth\Register::class)
            ->profile(EditProfile::class)
            ->font('Poppins')
<<<<<<< HEAD
=======
            ->favicon(asset('home.jpeg'))
>>>>>>> origin/main
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                CategoryChart::class,
                ChannelChart::class,
                RequestChart::class,
                UserChart::class
//                Widgets\AccountWidget::class,
//                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
//                VerifyIsAdmin::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([FilamentSpatieRolesPermissionsPlugin::make(), SpotlightPlugin::make(),
                LightSwitchPlugin::make()
                    ->position(Alignment::TopCenter),
                FilamentProgressbarPlugin::make()->color('#FBBF24'),
                ThemesPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make(),
                QuickCreatePlugin::make()->excludes((array)GuildResource::class),
            ])
            ->tenantMiddleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->resources([
                UserResource::class,
                config('filament-logger.activity_resource')
            ])
            ->navigationItems([NavigationItem::make('Ayarlar')
                ->icon(Setting::changeIconIfCurrentRouteIsEditSettings())->url(url('admin/settings/1/edit'))->group('Bot Ayarları')->sort(2)->activeIcon('heroicon-s-cog')
            ]);


    }
}
