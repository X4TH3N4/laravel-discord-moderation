<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'discord_id',
        'name',
        'guild_id',
        'type',
        'position',
        'owner_id',
        'category_mod_role_id',
        'category_user_role_id',
        'group_id'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'guild_id' => 'integer',
        'type' => 'string',
        'position' => 'integer'
    ];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'category_owners', 'category_id', 'member_id');
    }
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'category_members', 'category_id','member_id');
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function channels() : HasMany
    {
        return $this->hasMany(Channel::class);
    }

    public function guild() : BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function permissions() : HasMany
    {
        return $this->hasMany(GuildPermission::class);
    }

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(GuildRole::class, 'category_roles', 'guild_role_id');
    }


}
