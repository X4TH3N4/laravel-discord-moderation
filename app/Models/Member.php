<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Member extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'discord_id',
        'nick',
        'avatar',
        'joined_at',
        'premium_since',
        'deaf',
        'mute',
        'pending',
        'is_premium',
        'is_banned',
        'is_kicked',
        'is_in_timeout',
        'roles',
        'guild_role_id'
    ];


    public function channels() : BelongsToMany
    {
        return $this->belongsToMany(Channel::class, 'channel_members');
    }
    public function memberCategories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_members', 'member_id', 'category_id');
    }
    public function ownerCategories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_owners', 'member_id', 'category_id');
    }
    public function guilds() : BelongsToMany
    {
        return $this->belongsToMany(Guild::class, 'guild_members');
    }

    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(GuildPermission::class, 'member_permissions');
    }

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(GuildRole::class, 'member_roles', 'member_id');
    }

    public function bans() : HasMany
    {
        return $this->hasMany(Ban::class);
    }
    public function deafs() : HasMany
    {
        return $this->hasMany(Deaf::class);
    }
    public function kicks() : HasMany
    {
        return $this->hasMany(Kick::class);
    }
    public function mutes() : HasMany
    {
        return $this->hasMany(Mute::class);
    }
    public function timeouts() : HasMany
    {
        return $this->hasMany(Timeout::class);
    }

    public function requests() : BelongsToMany
    {
        return $this->belongsToMany(Request::class );
    }

}
