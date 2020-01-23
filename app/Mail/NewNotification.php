<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function  __construct( $notification )
    {
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reciever = \App\User::where("id", $this->notification->id_user)->first();
        $company = \App\Companies::where("id", \AppConfig::id_company)->first();
        return $this->view('mail/newNotification', array(
            "notification" => $this->notification,
            "company" => $company,
            "reciever" => $reciever
        ));
    }
}
