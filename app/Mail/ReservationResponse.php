<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $txt;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $txt )
    {
        $this->txt = $txt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('thecondadoclub@gmail.com')->subject('Your reservation at the Condado Club')->view('mail/response', array(
            "txt" => $this->txt
        ));
    }
}
