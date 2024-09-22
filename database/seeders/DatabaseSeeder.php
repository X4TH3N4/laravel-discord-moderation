<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Althinect\FilamentSpatieRolesPermissions\Commands\Permission;
use App\Models\GuildPermission;
use App\Models\GuildRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



    $this->call([
        ColorSeeder::class,
        MemberSeeder::class,
        GuildSeeder::class,
        PermissionRoleSeeder::class,
        SettingSeeder::class,
        GuildPermissionsSeeder::class,
        GuildRoleSeeder::class
    ]);
//    Artisan::call('permissions:sync -P');
    }
}
