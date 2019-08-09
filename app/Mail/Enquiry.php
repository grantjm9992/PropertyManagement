<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Enquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $enq;
    public $apt;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enq, $apt)
    {
        $this->enq = $enq;
        $this->apt = $apt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@mancsolutions.com')
                    ->subject("New Enquiry: Nueva Ribera Beach Club")
                    ->view('mail/enquiries', array(
                        "apt" => $this->apt,
                        "enq" => $this->enq
                    )
        );
    }
}
