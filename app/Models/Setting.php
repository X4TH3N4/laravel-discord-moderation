<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
      'guild_id',
      'public_guild_id',
      'message_channel_id',
      'login_logout_channel_id',
      'bot_ready_channel_id',
      'role_channel_id',
      'voice_activity_channel_id',
      'ban_channel_id',
      'kick_channel_id',
      'timeout_channel_id',
        'vip_role_id',
        'unregistered_role_id',
      'mute_channel_id',
      'announcement_channel_id',
      'rule_channel_id',
      'log_category_channel_id',
      'management_category_channel_id',
      'members_role_id',
      'bots_role_id',
        'token',
        'bot_id',
        'public1',
        'public2',
        'private',
        'private2',
    ];

    public function guild() : BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public static function changeIconIfCurrentRouteIsEditSettings() {
        if (request()->fullUrlIs('https://localhost.test/admin/settings/1/edit'))
        {
            return 'heroicon-s-cog-6-tooth';
            }
        return 'heroicon-o-cog-6-tooth';
    }
}
