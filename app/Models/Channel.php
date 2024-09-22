<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory;

    //      'GUILD_DIRECTORY',

    protected $fillable = [
        'id',
        'name',
        'type',
        'guild_id',
        'topic',
        'nsfw',
        'bitrate',
        'user_limit',
        'discord_id',
        'cooldown',
        'owner_id',
        'position',
        'category_id',
        'group_id'
    ];

//    public static array $types = [
//     0 => 'GUILD_TEXT',
//     2 => 'GUILD_VOICE',
//     4 =>  'GUILD_CATEGORY',
//     5 => 'GUILD_ANNOUNCEMENT',
//     13 => 'GUILD_STAGE_VOICE',
//     15 => 'GUILD_FORUM',
//    ];

//     4 =>  'GUILD_CATEGORY',

    public static array $types = [
        'GUILD_TEXT' => 'Yazılı',
        'GUILD_VOICE' => 'Sesli',
        'GUILD_ANNOUNCEMENT' => 'Duyuru',
        'GUILD_STAGE_VOICE' => 'Konferans',
        'GUILD_FORUM' => 'Forum',
    ];

    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class, 'guild_id');
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(GuildPermission::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(GuildRole::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }


}
