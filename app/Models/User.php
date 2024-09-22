<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use App\Filament\Roof\Resources\GuildRoleResource\Pages\ListGuildRoles;
use App\Observers\UserObserver;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Jakyeru\Larascord\Services\DiscordService;
use Jakyeru\Larascord\Traits\InteractsWithDiscord;
use Jakyeru\Larascord\Types\AccessToken;
use Jakyeru\Larascord\Types\GuildMember;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements HasAvatar, FilamentUser, HasName, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithDiscord, HasSuperAdmin, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'username',
        'name',
        'global_name',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'banner',
        'banner_color',
        'accent_color',
        'locale',
        'mfa_enabled',
        'premium_type',
        'public_flags',
        'roles',
        'is_premium',
        'is_admin',
        'is_activated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */


    protected $casts = [
        'name' => 'string',
        'id' => 'integer',
        'username' => 'string',
        'global_name' => 'string',
        'discriminator' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'verified' => 'boolean',
        'banner' => 'string',
        'banner_color' => 'string',
        'accent_color' => 'string',
        'locale' => 'string',
        'mfa_enabled' => 'boolean',
        'premium_type' => 'integer',
        'public_flags' => 'integer',
        'roles' => 'json',
    ];


    public static function checkRole(string $roleName): bool
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        $role = Role::query()->where('name', $roleName)->first();
        if (!$role) {
            return false;
        }

        return DB::table('model_has_roles')->where('role_id', $role->id)->where('model_id', $user->id)->exists();
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function requests() : HasMany
    {
        return $this->hasMany(Request::class);
    }

    public static function isAdmin() : bool {
       return self::checkRole('Super Admin');
}

    public function canAccessPanel(Panel $panel): bool
    {
        if (Auth::user() && Auth::user()->is_activated)
        {
            return true;
        }

        Auth::logout();
        return false;
    }

    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'user_messages', 'message_id');
    }

    public function bans(): HasMany
    {
        return $this->hasMany(Ban::class);
    }

    public function deafs(): HasMany
    {
        return $this->hasMany(Deaf::class);
    }

    public function kicks(): HasMany
    {
        return $this->hasMany(Kick::class);
    }

    public function mutes(): HasMany
    {
        return $this->hasMany(Mute::class);
    }

    public function timeouts(): HasMany
    {
        return $this->hasMany(Timeout::class);
    }

    public function getFilamentName(): string
    {
        return (string)($this->global_name);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return Auth::user()->getAvatar(['webp', 64, 2]);
    }

}
