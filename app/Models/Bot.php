<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bot extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'token',
        'name',
        'status',
        'activity_name',
        'activity_url',
        'activity_type'
    ];
    public static array $activityStatus = [
        'online' => 'Çevrimiçi',
        'idle' => 'Boşta',
        'invisible' => 'Görünmez',
        'dnd' => 'Rahatsız Etmeyin'
    ];
    public static array $activityTypes = [
        'ActivityType.Competing' => 'Yarışıyor',
        'ActivityType.Custom' => 'Custom',
        'ActivityType.Listening' => 'Dinliyor',
        'ActivityType.Playing' => 'Oynuyor',
        'ActivityType.Streaming' => 'Yayında',
        'ActivityType.Watching' => 'İzliyor'
    ];

}
