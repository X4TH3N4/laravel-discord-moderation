<?php

namespace App\Providers;

use App\Models\Guild;
use App\Models\GuildRole;
use App\Models\User;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Doctrine\DBAL\Query;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\HorizonCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\RedisMemoryUsageCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!App::runningInConsole()) {
            $guildArray = Guild::all()->pluck('discord_id', 'id')->toArray();
            $guildRoleArray = [];

            foreach ($guildArray as $key=>$guild) {
                $guildRoleArray[$guild] = GuildRole::query()->where('guild_id', $key)->whereHas('permissions', function ($query) {
                    return $query->where('guild_permission_id', 4);
                })->pluck('discord_id')->toArray();
            }

           Config::set('larascord.guilds', $guildArray);
           Config::set('larascord.guild_roles', $guildRoleArray);
        }

        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            CacheCheck::new(),
            DatabaseCheck::new(),
//            UsedDiskSpaceCheck::new(),
        ]);

        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
            ->simple()
                ->labels([
                    'roof' => 'Ana Menü',
                    'admin' => 'Yönetim Menüsü'
                ])->icons([
                'roof' => 'heroicon-m-shield-exclamation',
                'admin' => 'heroicon-m-user-circle',
            ]);
        });

    }
}
