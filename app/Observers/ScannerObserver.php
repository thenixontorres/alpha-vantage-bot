<?php

namespace App\Observers;

use App\Models\Scanner;

class ScannerObserver
{
    /**
     * Handle the  scanner "created" event.
     *
     * @param  \App\Scanner  $Scanner
     * @return void
     */
    public function created(Scanner $Scanner)
    {
        //
    }

    /**
     * Handle the  scanner "updated" event.
     *
     * @param  \App\Scanner  $Scanner
     * @return void
     */
    public function updated(Scanner $Scanner)
    {
        //
    }

    /**
     * Handle the  scanner "deleted" event.
     *
     * @param  \App\Scanner  $Scanner
     * @return void
     */
    public function deleted(Scanner $Scanner)
    {
        $scanner->strategies()->detach();
        
        foreach ($scanner->signals as $signal) 
        {
            $signal->delete();
        }
    }

    /**
     * Handle the  scanner "restored" event.
     *
     * @param  \App\Scanner  $Scanner
     * @return void
     */
    public function restored(Scanner $Scanner)
    {
        //
    }

    /**
     * Handle the  scanner "force deleted" event.
     *
     * @param  \App\Scanner  $Scanner
     * @return void
     */
    public function forceDeleted(Scanner $Scanner)
    {
        //
    }
}
