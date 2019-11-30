<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $message )
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sender = \App\User::where("id", $this->message->id_user)->first();
        $company = \App\Companies::where("id", \AppConfig::id_company)->first();
        return $this->view('mail/newmessage', array(
            "notification" => $this->message,
            "company" => $company,
            "sender" => $sender
        ));
    }
}
