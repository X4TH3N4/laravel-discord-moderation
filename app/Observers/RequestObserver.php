<?php

namespace App\Observers;

use App\Enums\Request\StatusEnum;
use App\Models\Request;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class RequestObserver
{
    /**
     * Handle the Request "created" event.
     */

    public function created(Request $request): void
    {

        if (User::isAdmin() === true) {
            $request->admin_id = Auth::user()->id;
            $request->status = StatusEnum::APPROVED;
            $request->author_id = Auth::user()->id;
            $request->saveQuietly();
        } else {
            $request->status = StatusEnum::WAITING;
            $request->author_id = Auth::user()->id;
            $request->saveQuietly();
        }
    }

    /**
     * Handle the Request "updated" event.
     */
    public function updating(Request $request): void
    {
        $beforeStatus = $request->getOriginal('status');

        if (User::isAdmin()) {

            if ($request->status->value === 'approved')
            {
                $request->admin_id = Auth::user()->id;
                $request->updateQuietly();
            }
            else if ($request->status->value === 'denied')
            {
                $request->admin_id = Auth::user()->id;
                $request->updateQuietly();
            }
            else if ($request->status->value === 'waiting')
            {
                $request->admin_id = Auth::user()->id;
                $request->updateQuietly();
            }

        } else {
            if ($request->status->value === 'approved')
            {
                $request->status = $beforeStatus;
                $request->updateQuietly();
            }
            else if ($request->status->value === 'denied')
            {
                $request->status = $beforeStatus;
                $request->updateQuietly();
            }
            else if ($request->status->value === 'waiting')
            {
                $request->status = $beforeStatus;
                $request->updateQuietly();
            }
            else {
                $request->status = 'waiting';
                $request->updateQuietly();
            }


        }
    }


    public function updated(Request $request): void
    {



    }


    /**
     * Handle the Request "deleted" event.
     */
    public function deleted(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "restored" event.
     */
    public function restored(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "force deleted" event.
     */
    public function forceDeleted(Request $request): void
    {
        //
    }
}
