<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'int',
        'hex'
    ];


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(GuildRole::class, 'guild_roles', 'color_id');
    }

    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'messages', 'color_id');
    }
}
