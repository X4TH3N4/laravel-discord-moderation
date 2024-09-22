<?php

namespace Database\Seeders;

use App\Models\GuildPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class GuildPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'CreateInstantInvite' => [
                'name' => 'Anında Davet Oluştur',
                'description' => 'Sunucuda anında davet oluşturma yetkisi'
            ],
            'KickMembers' => [
                'name' => 'Üyeleri At',
                'description' => 'Sunucudan üyeleri atma yetkisi'
            ],
            'BanMembers' => [
                'name' => 'Üyeleri Yasakla',
                'description' => 'Sunucudan üyeleri yasaklama yetkisi'
            ],
            'Administrator' => [
                'name' => 'Yönetici',
                'description' => 'Sunucuda yönetici yetkisi'
            ],
            'ManageChannels' => [
                'name' => 'Kanalları Yönet',
                'description' => 'Sunucudaki kanalları yönetme yetkisi'
            ],
            'ManageGuild' => [
                'name' => 'Sunucuyu Yönet',
                'description' => 'Sunucuyu yönetme yetkisi'
            ],
            'AddReactions' => [
                'name' => 'Tepki Ekle',
                'description' => 'Mesajlara tepki ekleme yetkisi'
            ],
            'ViewAuditLog' => [
                'name' => 'Denetim Kaydını Görüntüle',
                'description' => 'Denetim kaydını görüntüleme yetkisi'
            ],
            'PrioritySpeaker' => [
                'name' => 'Öncelikli Konuşmacı',
                'description' => 'Öncelikli konuşmacı yetkisi'
            ],
            'Stream' => [
                'name' => 'Yayın Yap',
                'description' => 'Sesli kanalda yayın yapma yetkisi'
            ],
            'ViewChannel' => [
                'name' => 'Kanalı Görüntüle',
                'description' => 'Kanalı görüntüleme yetkisi'
            ],
            'SendMessages' => [
                'name' => 'Mesaj Gönder',
                'description' => 'Mesaj gönderme yetkisi'
            ],
            'SendTTSMessages' => [
                'name' => 'TTS Mesajı Gönder',
                'description' => 'TTS mesajı gönderme yetkisi'
            ],
            'ManageMessages' => [
                'name' => 'Mesajları Yönet',
                'description' => 'Mesajları yönetme yetkisi'
            ],
            'EmbedLinks' => [
                'name' => 'Bağlantıları Göm',
                'description' => 'Bağlantıları gömme yetkisi'
            ],
            'AttachFiles' => [
                'name' => 'Dosya Ekle',
                'description' => 'Dosya ekleme yetkisi'
            ],
            'ReadMessageHistory' => [
                'name' => 'Mesaj Geçmişini Oku',
                'description' => 'Mesaj geçmişini okuma yetkisi'
            ],
            'MentionEveryone' => [
                'name' => 'Herkesi Etiketle',
                'description' => 'Herkesi etiketleme yetkisi'
            ],
            'UseExternalEmojis' => [
                'name' => 'Harici Emojileri Kullan',
                'description' => 'Harici emojileri kullanma yetkisi'
            ],
            'ViewGuildInsights' => [
                'name' => 'Sunucu İstatistiklerini Görüntüle',
                'description' => 'Sunucu istatistiklerini görüntüleme yetkisi'
            ],
            'Connect' => [
                'name' => 'Bağlan',
                'description' => 'Sesli kanala bağlanma yetkisi'
            ],
            'Speak' => [
                'name' => 'Konuş',
                'description' => 'Sesli kanalda konuşma yetkisi'
            ],
            'MuteMembers' => [
                'name' => 'Üyeleri Sustur',
                'description' => 'Üyeleri susturma yetkisi'
            ],
            'DeafenMembers' => [
                'name' => 'Üyeleri Sağırlaştır',
                'description' => 'Üyeleri sağır yapma yetkisi'
            ],
            'MoveMembers' => [
                'name' => 'Üyeleri Taşı',
                'description' => 'Üyeleri taşıma yetkisi'
            ],
            'UseVAD' => [
                'name' => 'VAD Kullan',
                'description' => 'VAD (Voice Activity Detection) kullanma yetkisi'
            ],
            'ChangeNickname' => [
                'name' => 'Takma Ad Değiştir',
                'description' => 'Kullanıcıların takma adlarını değiştirme yetkisi'
            ],
            'ManageNicknames' => [
                'name' => 'Takma Adları Yönet',
                'description' => 'Takma adları yönetme yetkisi'
            ],
            'ManageRoles' => [
                'name' => 'Rolleri Yönet',
                'description' => 'Rolleri yönetme yetkisi'
            ],
            'ManageWebhooks' => [
                'name' => 'Webhookları Yönet',
                'description' => 'Webhookları yönetme yetkisi'
            ],
            'ManageEmojisAndStickers' => [
                'name' => 'Emojileri ve Stickerları Yönet',
                'description' => 'Emojileri ve stickerları yönetme yetkisi'
            ],
            'ManageGuildExpressions' => [
                'name' => 'Sunucu İfadelerini Yönet',
                'description' => 'Sunucu ifadelerini yönetme yetkisi'
            ],
            'UseApplicationCommands' => [
                'name' => 'Uygulama Komutlarını Kullan',
                'description' => 'Uygulama komutlarını kullanma yetkisi'
            ],
            'RequestToSpeak' => [
                'name' => 'Konuşma İsteği Gönder',
                'description' => 'Konuşma isteği gönderme yetkisi'
            ],
            'ManageEvents' => [
                'name' => 'Etkinlikleri Yönet',
                'description' => 'Etkinlikleri yönetme yetkisi'
            ],
            'ManageThreads' => [
                'name' => 'Konuları Yönet',
                'description' => 'Konuları yönetme yetkisi'
            ],
            'CreatePublicThreads' => [
                'name' => 'Açık Konu Oluştur',
                'description' => 'Açık konu oluşturma yetkisi'
            ],
            'CreatePrivateThreads' => [
                'name' => 'Özel Konu Oluştur',
                'description' => 'Özel konu oluşturma yetkisi'
            ],
            'UseExternalStickers' => [
                'name' => 'Harici Stickerları Kullan',
                'description' => 'Harici stickerları kullanma yetkisi'
            ],
            'SendMessagesInThreads' => [
                'name' => 'Konularda Mesaj Gönder',
                'description' => 'Konularda mesaj gönderme yetkisi'
            ],
            'UseEmbeddedActivities' => [
                'name' => 'Gömülü Etkinlikleri Kullan',
                'description' => 'Gömülü etkinlikleri kullanma yetkisi'
            ],
            'ModerateMembers' => [
                'name' => 'Üyeleri Yönet',
                'description' => 'Üyeleri yönetme yetkisi'
            ],
            'ViewCreatorMonetizationAnalytics' => [
                'name' => 'Yaratıcı Monetizasyon Analitiklerini Görüntüle',
                'description' => 'Yaratıcı monetizasyon analitiklerini görüntüleme yetkisi'
            ],
            'UseSoundboard' => [
                'name' => 'Ses Panosu Kullan',
                'description' => 'Ses panosu kullanma yetkisi'
            ],
            'UseExternalSounds' => [
                'name' => 'Harici Sesleri Kullan',
                'description' => 'Harici sesleri kullanma yetkisi'
            ],
            'SendVoiceMessages' => [
                'name' => 'Sesli Mesaj Gönder',
                'description' => 'Sesli mesaj gönderme yetkisi'
            ]
        ];

        foreach ($permissions as $key => $value) {
            GuildPermission::query()->create([
                'key' => $key,
                'name' => $value['name'],
                'description' => $value['description']
            ]);
        }

    }
}
