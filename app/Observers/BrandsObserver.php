<?php

namespace App\Observers;

use App\Models\brands;
use Illuminate\Support\Facades\Storage;

class BrandsObserver
{

    function deleteLogo($logo)
    {
        if (!empty($logo) && Storage::exists($logo)) {
            Storage::delete($logo);
        }
    }
    /**
     * Handle the brands "created" event.
     */
    public function created(brands $brands): void
    {
        //
    }

    /**
     * Handle the brands "updated" event.
     */
    public function updated(brands $brands): void
    {
        //
    }

    /**
     * Handle the brands "deleted" event.
     */
    public function deleted(brands $brands): void
    {
        $this->deleteLogo($brands->logo);
    }

    /**
     * Handle the brands "restored" event.
     */
    public function restored(brands $brands): void
    {
        //
    }

    /**
     * Handle the brands "force deleted" event.
     */
    public function forceDeleted(brands $brands): void
    {
        //
    }
}
