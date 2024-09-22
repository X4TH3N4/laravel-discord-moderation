<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GuildRole extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'name',
        'hoist',
        'icon',
        'unicode_emoji',
        'position',
        'permissions',
        'managed',
        'mentionable',
        'tags',
        'flags',
        'category_id',
        'color_id',
        'member_id',
        'guild_id',
        'discord_id'
    ];


    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function channels() : BelongsToMany
    {
        return $this->belongsToMany(Channel::class, 'channel_roles');
    }
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_roles');
    }

    public function guild() : BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(GuildPermission::class, 'role_permissions');
    }

    public function members() : BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_roles', 'guild_role_id');
    }
}
