<?php

namespace App\Observers;

use App\Models\categories;
use Illuminate\Support\Facades\Storage;

class CategoriesObserver
{
    /**
     * Handle the categories "created" event.
     */
    public function created(categories $categories): void
    {
        //
    }

    /**
     * Handle the categories "updated" event.
     */
    public function updated(categories $categories): void
    {
        //
    }

    /**
     * Handle the categories "deleted" event.
     */
    public function deleted(categories $categories): void
    {
        if (!empty($categories->thumbnail) && Storage::exists($categories->thumbnail)) {
            Storage::delete($categories->thumbnail);
        }
    }

    /**
     * Handle the categories "restored" event.
     */
    public function restored(categories $categories): void
    {
        //
    }

    /**
     * Handle the categories "force deleted" event.
     */
    public function forceDeleted(categories $categories): void
    {
        //
    }
}
