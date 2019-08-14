<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignalNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $signal;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($signal)
    {
        $this->signal = $signal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[TURTRADING] Nueva alerta')->view('emails.signalNotificationMail');
    }
}
