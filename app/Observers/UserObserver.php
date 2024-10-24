<?php

namespace App\Observers;

use App\Models\user;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the user "created" event.
     */
    public function created(user $user): void
    {
        //
    }

    /**
     * Handle the user "updated" event.
     */
    public function updated(user $user): void
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     */
    public function deleted(user $user): void
    {
        if ($user->photo_url && Storage::exists($user->photo_url)) {
            Storage::delete($user->photo_url);
        }
    }

    /**
     * Handle the user "restored" event.
     */
    public function restored(user $user): void
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     */
    public function forceDeleted(user $user): void
    {
        //
    }
}
