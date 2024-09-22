<?php

namespace Database\Seeders;

use App\Models\Guild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuildSeeder extends Seeder
{
    private $guilds = [
        [
            'id' => 1,
            'discord_id' => 1148179347325333564,
            'name' => 'Laravel Discord Test',
            'description' => 'Örnek sunucu açıklaması',
            'icon' => 'sunucuresmi.png',
//            'owner' => true,
            'owner_id' => 339375543038377986,
        ]
    ];

    public function run(): void
    {
        foreach ($this->guilds as $guild) {
            Guild::query()->updateOrCreate([
                'id' => $guild['id'],
            ], $guild);
        }
    }
}
