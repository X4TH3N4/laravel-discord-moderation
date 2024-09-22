<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //            $table->string('voice_activity_channel_id')->nullable();
    //            $table->string('ban_channel_id')->nullable();
    //            $table->string('')->nullable();
    //            $table->string('')->nullable();
    //            $table->string('')->nullable();
    //            $table->string('timeout_channel_id')->nullable();
    //            $table->string('mute_channel_id')->nullable();
    //            $table->string('announcement_channel_id')->nullable();
    //            $table->string('rule_channel_id')->nullable();
    //            $table->string('log_category_channel_id')->nullable();  //  LOG KATEGORİSİNİN IDSİ
    //            $table->string('management_category_channel_id')->nullable();   //  YÖNETİM KATEGORİSİNİN IDSİ
    //            $table->string('members_role_id')->nullable();
    //            $table->string('bots_role_id')->nullable();
    //            $table->boolean('private')->nullable();
    //            $table->boolean('private2')->nullable();
    //            $table->boolean('public1')->nullable();
    //            $table->boolean('public2')->nullable();

    private $settings = [
        [
            'id' => 1,
            'token' => "8368435786894578967894589679879",
            'bot_id' => "1151498918572589148",
            'guild_id' => "1",
            'message_channel_id' => "1155264147005657148",
            'login_logout_channel_id' => "1155264562912829440",
            'bot_ready_channel_id' => "1155264790428655616",
            'role_channel_id' => "1155265554043642018",
            'voice_activity_channel_id' => "1155265624814141480",
            'ban_channel_id' => "1155265698940076113",
            'kick_channel_id' => "1155265783077810176",
            'vip_role_id' => "1155265860886331496",
            'unregistered_role_id' => "1155265958529740962",
            'timeout_channel_id' => "1148179348524900364",
            'mute_channel_id' => "1148179348524900364",
            'announcement_channel_id' => "1154101726345969684",
            'rule_channel_id' => "1154101747699155044",
            'members_role_id' => "1154101726345969684",
            'bots_role_id' => "1154101747699155044",
            'private' => 1,
            'private2' => 1,
            'public1' => 1,
            'public2' => 1,
        ]];


    public function run(): void
    {
        foreach ($this->settings as $setting) {
            Setting::query()->updateOrCreate([
                'id' => $setting['id'],
            ], $setting);
        }
    }
}
