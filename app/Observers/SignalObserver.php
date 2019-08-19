<?php

namespace App\Observers;

use App\Models\Signal;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignalNotificationMail;
use Telegram\Bot\Laravel\Facades\Telegram;

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
        /*Notficacion cada vez que se crea una senal*/
        $to = $signal->scanner->user->email;
        //$cc = getSetting('notifications_mail');        
        Mail::to($to)->send(new SignalNotificationMail($signal));
        
        /*Mensaje al pool de alertas (TELEGRAM)*/
        $text = "<b>Nueva alerta:</b>:\n"
        . "<b>USUARIO: </b>" . $signal->scanner->user->name . "\n"
        . "<b>ACTIVO: </b>" . $signal->scanner->merged_symbols . "\n"
        . "<b>TIPO: </b>" . $signal->just_type . "\n"
        . "<b>FECHA: </b>" . $signal->time_signal . "\n";

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID'),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
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
