<?php

namespace App\Observers;

use App\Models\Asset;

class AssetObserver
{
    /**
     * Handle the asset "created" event.
     *
     * @param  \App\Asset  $asset
     * @return void
     */
    public function created(Asset $asset)
    {
        //
    }

    /**
     * Handle the asset "updated" event.
     *
     * @param  \App\Asset  $asset
     * @return void
     */
    public function updated(Asset $asset)
    {
        //
    }

    /**
     * Handle the asset "deleted" event.
     *
     * @param  \App\Asset  $asset
     * @return void
     */
    public function deleted(Asset $asset)
    {
        foreach ($asset->scanners as $scanner) 
        {
            $scanner->delete();
        }
    }

    /**
     * Handle the asset "restored" event.
     *
     * @param  \App\Asset  $asset
     * @return void
     */
    public function restored(Asset $asset)
    {
        //
    }

    /**
     * Handle the asset "force deleted" event.
     *
     * @param  \App\Asset  $asset
     * @return void
     */
    public function forceDeleted(Asset $asset)
    {
        //
    }
}
