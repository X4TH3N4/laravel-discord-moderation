<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Message;
use App\Models\Request;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ChannelObserver;
use App\Observers\MessageObserver;
use App\Observers\RequestObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Channel::observe(ChannelObserver::class);
        Request::observe(RequestObserver::class);
        Category::observe(CategoryObserver::class);
        Message::observe(MessageObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
