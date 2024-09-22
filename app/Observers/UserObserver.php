<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UserObserver
{

    public function creating(User $user): void
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
            $user->name = $user->global_name;
            $password = Str::password(16);
//            $user->password = bcrypt($password);
            $user->password = $password;
            $user->assignRole('User');
            $user->addMediaFromUrl("https://cdn.discordapp.com/avatars/{$user->id}/$user->avatar")->toMediaCollection('avatars');
        $user->saveQuietly();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
