<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Ban;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Color;
use App\Models\Deaf;
use App\Models\Guild;
use App\Models\GuildPermission;
use App\Models\GuildRole;
use App\Models\Kick;
use App\Models\Member;
use App\Models\Message;
use App\Models\Mute;
use App\Models\Request;
use App\Models\Timeout;
use App\Models\User;
use App\Policies\RequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        Ban::class => BanPolicy::class,
//        Admin::class => BotPolicy::class,
//        Category::class => CategoryPolicy::class,
//        Channel::class  => ChannelPolicy::class,
//        Color::class => ColorPolicy::class,
//        Deaf::class => DeafPolicy::class,
//        GuildPermission::class  => GuildPermissionPolicy::class,
//        Guild::class  => GuildPolicy::class,
//        GuildRole::class  => GuildRolePolicy::class,
//        Kick::class => KickPolicy::class,
//        Member::class  => MemberPolicy::class,
//        Message::class  => MessagePolicy::class,
//        Mute::class  => MutePolicy::class,
//        Permission::class  => PermissionPolicy::class,
//        Role::class  => RolePolicy::class,
//        Timeout::class  => TimeoutPolicy::class,
//        User::class  => UserPolicy::class
//    Request::class => RequestPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */

    public function boot(): void
    {
//        $this->registerPolicies();
//        Gate::before(function (User $user, string $ability) {
//            return User::isAdmin() ? true: null;
//        });
    }
}
