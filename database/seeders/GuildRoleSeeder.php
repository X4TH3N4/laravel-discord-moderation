<?php

namespace Database\Seeders;

use App\Models\GuildPermission;
use App\Models\GuildRole;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuildRoleSeeder extends Seeder
{
    private $roles = [
        [
            'id' => 1,
            'guild_id' => 1,
            'discord_id' => '1155224304259182853',
            'name' => 'Yönetim',
        ]
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            /** @var GuildRole $dcRole */
            $dcRole = GuildRole::query()->updateOrCreate([
                'id' => $role['id'],
            ], $role);

            $dcRole->permissions()->sync([4
            ]);

        }
    }
}
