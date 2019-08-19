<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    

    public function getForCard()
    {
        $last_message = \App\Messages::where('id_conversation', $this->id)->orderBy('date_sent', 'DESC')->first();
        $sender = \App\User::where('id', $last_message->id_sender)->first();
        $this->sender = $sender->name." ".$sender->surname;
        $date = new \DateTime( $last_message->date_sent );
        /**
         * 
         *  INCLUDE THIS NEW LOGIC CLASS AT SOME POINT PLEASE
         */
   //     $this->last_message = \DateFormatter::makeMessageDate($date);

        $this->image = ( file_exists( $sender->image ) ) ? $sender->image : "img/user.png";
        $this->message = $last_message->message;
    }
}
