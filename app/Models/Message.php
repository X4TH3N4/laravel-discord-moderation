<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    //attachments
    //embeds
    //files



    protected $fillable = [
        'id',
        'discord_id',
        'content',
        'user_id', //MESSAGE OWNER
        'guild_id',
        'channel_id',
        'category_id',
        'color_id',
        'type', //default
        'is_pinable'
    ];

    public static array $types = [
        'DEFAULT' => 'Varsayılan'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guild() : BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function channel() : BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
