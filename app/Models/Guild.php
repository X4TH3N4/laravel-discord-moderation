<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Guild extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'discord_id',
        'name',
        'description',
        'icon',
        'icon_hash',
        'splash',
        'discovery_splash',
        'owner',
        'owner_id',
        'region',
        'afk_channel_id',
        'afk_timeout',
        'widget_enabled',
        'widget_channel_id',
        'verification_level',
        'default_message_notifications',
        'explicit_content_filter',
        'roles',
        'emojis',
        'features',
        'mfa_level',
        'application_id',
        'system_channel_id',
        'rules_channel_id',
        'max_presences',
        'max_members',
        'vanity_url_code',
        'banner',
        'premium_tier',
        'premium_subscription_count',
        'preferred_locale',
        'public_updates_channel_id',
        'max_video_channel_users',
        'max_stage_video_channel_users',
        'approximate_member_count',
        'approximate_presence_count',
        'welcome_screen',
        'nsfw_level',
        'stickers',
        'premium_progress_bar_enabled',
        'safety_alerts_channel_id'
    ];

    public function channels() : HasMany
    {
        return $this->hasMany(Channel::class);
    }

    public function categories() : HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function permissions() : HasMany
    {
        return $this->hasMany(GuildPermission::class);
    }

    public function roles() : HasMany
    {
        return $this->hasMany(GuildRole::class);
    }

    public function members() : HasMany
    {
        return $this->hasMany(Member::class);
    }

}
