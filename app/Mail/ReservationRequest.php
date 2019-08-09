<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $fromEmail;
    public $name;
    public $tel;
    public $date;
    public $time;
    public $people;
    public $acceptURL;
    public $rejectURL;
    public $reservation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $reservation )
    {
        $this->fromEmail = $_REQUEST['email'];
        $this->from( $_REQUEST['email'] );
        $this->name = $_REQUEST['name'];
        $this->tel = $_REQUEST['tel'];
        $tdate = new \DateTime($_REQUEST['date'] );
        $this->date = $tdate->format('d/m/Y');
        $this->time = $_REQUEST['time'];
        $this->people = $_REQUEST['people'];

        $this->reservation = $reservation;

        $this->acceptURL = url("Reservation.response?response=1&id=".base64_encode($this->reservation->id));
        $this->rejectURL = url("Reservation.response?response=0&id=".base64_encode($this->reservation->id));

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->
        from('info@thecondadoclub.com')->subject('A new reservation request for the Condado Club')->
        view('mail/request', array(
            "name" => $this->name,
            "tel" => $this->tel,
            "date" => $this->date,
            "time" => $this->time,
            "people" => $this->people
        ));
    }
}
