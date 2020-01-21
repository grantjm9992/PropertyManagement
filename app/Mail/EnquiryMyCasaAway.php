<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryMyCasaAway extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $subject, $msg)
    {
        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@mycasaaway.com')
                    ->subject("New Enquiry")
                    ->view('mail/enquirymycasaaway', array(
                        "name" => $this->name,
                        "email" => $this->email,
                        "subject" => $this->subject,
                        "message" => $this->msg
                    )
        );
    }
}