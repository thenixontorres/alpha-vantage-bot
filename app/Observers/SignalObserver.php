<?php

namespace App\Observers;

use App\Models\Signal;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignalNotificationMail;

class SignalObserver
{
    /**
     * Handle the signal "created" event.
     *
     * @param  \App\Signal  $signal
     * @return void
     */
    public function created(Signal $signal)
    {
        $to = getSetting('notifications_mail');
        //return new SignalNotificationMail($signal);
        /*Notficacion cada vez que se crea una senal*/
        Mail::to($to)->queue(new SignalNotificationMail($signal));
    }

    /**
     * Handle the signal "updated" event.
     *
     * @param  \App\Signal  $signal
     * @return void
     */
    public function updated(Signal $signal)
    {
        //
    }

    /**
     * Handle the signal "deleted" event.
     *
     * @param  \App\Signal  $signal
     * @return void
     */
    public function deleted(Signal $signal)
    {
        //
    }

    /**
     * Handle the signal "restored" event.
     *
     * @param  \App\Signal  $signal
     * @return void
     */
    public function restored(Signal $signal)
    {
        //
    }

    /**
     * Handle the signal "force deleted" event.
     *
     * @param  \App\Signal  $signal
     * @return void
     */
    public function forceDeleted(Signal $signal)
    {
        //
    }
}
