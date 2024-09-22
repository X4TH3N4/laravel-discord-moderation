<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    //        'GUILD_TEXT' => 'Yazılı',
    //        'GUILD_VOICE' => 'Sesli',
    //        'GUILD_ANNOUNCEMENT' => 'Duyuru',
    //        'GUILD_STAGE_VOICE' => 'Konferans',
    //        'GUILD_FORUM' => 'Forum',

    private $channels = [
        [
            'id' => 13696,
            'name' => 'mesaj-log',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Mesaj logları burada gözükür.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152327334952971,
            'position' => 0,
        ],
        [
            'id' => 13602,
            'name' => 'giris-cikis-log',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Sunucuya giriş çıkış logları burada gözükür.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152327334952971,
            'position' => 1,
        ],
        [
            'id' => 13606,
            'name' => 'rol-log',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Rol al ver logları burada gözükür.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152327334952971,
            'position' => 2,
        ],
        [
            'id' => 134743896,
            'name' => 'ses-log',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Ses kanallarına giriş çıkış logları burada gözükür.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152327334952971,
            'position' => 3,
        ],
        [
            'id' => 654346437896,
            'name' => 'mod-log',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Moderasyon değişikliliklerinin hepsi burda gözükür.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152327334952971,
            'position' => 4,
        ],
        [
            'id' => 182357896,
            'name' => 'mod-sohbet',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Yetkili sohbet odası.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152306199859271,
            'position' => 2,
        ],
        [
            'id' => 136007896,
            'name' => 'mod-görsel',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Yetkili görsel odası.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152306199859271,
            'position' => 3,
        ],
        [
            'id' => 77896,
            'name' => 'mod-duyuru',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Yetkili duyuru odası.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152306199859271,
            'position' => 1,
        ],
        [
            'id' => 13603679769659436,
            'name' => 'Toplantı Sesli',
            'type' => 2,
            'guild_id' => 1148179347325333564,
            'topic' => 'Yetkili sesli toplantı odası.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152306199859271,
            'position' => 0,
        ],
        [
            'id' => 436437896,
            'name' => 'sohbet',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Genel sohbet kanalı.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 2,
        ],
        [
            'id' => 13603412364896,
            'name' => 'içerik',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Görsel ve video paylaşma kanalı',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 3,
        ],
        [
            'id' => 1360341236432,
            'name' => 'bot-komut',
            'type' => '0',
            'guild_id' => 1148179347325333564,
            'topic' => 'Bot komutlarını girebileceğiniz, müzik açabileceğiniz kanal.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 4,
        ],
        [
            'id' => 6792356,
            'name' => 'Sesli Sohbet',
            'type' => '2',
            'guild_id' => 1148179347325333564,
            'topic' => 'Herkesin sesli sohbet edebileceği kanal.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 0,
        ],
        [
            'id' => 196,
            'name' => 'kurallar',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Sunucunun bütün kurallarının içerdiği oda.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 0,
        ],
        [
            'id' => 834634806347896,
            'name' => 'duyuru',
            'type' => 0,
            'guild_id' => 1148179347325333564,
            'topic' => 'Sunucudaki bütün duyurularının yapılacağı oda.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 1,
        ],
        [
            'id' => 6900747896,
            'name' => 'Podcast',
            'type' => '13',
            'guild_id' => 1148179347325333564,
            'topic' => 'Podcast gibi içerikleri üretme odası.',
            'owner_id' => 339375543038377986,
            'category_id' => 1155152355080290364,
            'position' => 6,
        ],

    ];


    public function run(): void
    {
        foreach ($this->channels as $channel) {
            Channel::query()->updateOrCreate([
                'id' => $channel['id'],
            ], $channel);
        }
    }
}
