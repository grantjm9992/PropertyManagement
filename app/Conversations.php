<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    

    public function getForCard()
    {
        $last_message = \App\Messages::where('id_conversation', $this->id)->orderBy('date_sent', 'DESC')->first();
        $sender = \App\User::where('id', $last_message->id_sender)->first();
        //$this->sender = $sender->name." ".$sender->surname;
        $cu = ConversationsUsers::where("id_conversation", $this->id)->get();
        $sender = "";
        foreach ( $cu as $row )
        {
            if ( (int)$row->id_user !== \UserLogic::getUserId() )
            {
                $user = User::where("id", $row->id_user)->first();
                $sender .= $user->name." ".$user->surname.", ";
                $image = ( file_exists( $user->image ) ) ? $user->image : "img/user.png";
            }
        }

        $sender = substr($sender, 0, strlen($sender) - 2 );
        $this->sender = $sender;

        $date = new \DateTime( $last_message->date_sent );
        /**
         * 
         *  INCLUDE THIS NEW LOGIC CLASS AT SOME POINT PLEASE
         */
   //     $this->last_message = \DateFormatter::makeMessageDate($date);

        $this->image = ( file_exists( $image ) ) ? $image : "img/user.png";
        $this->message = $last_message->message;
        $this->is_read = $last_message->is_read;
        $this->id_sender = $last_message->id_sender;
    }


    public static function getUnseenForUser()
    {
        $messages = array();
        $id = \UserLogic::getUserId();
        $convU = ConversationsUsers::where("id_user", $id)->get();
        foreach ( $convU as $row )
        {
            $last_message = Messages::where("id_conversation", $row->id_conversation)->orderBy("date_sent", "DESC")->first();
            if ( (int)$last_message->id_sender !== $id && (int)$last_message->is_read !== 1 )
            {
                $conversation = self::where("id", $row->id_conversation)->first();
                $messages[] = $conversation;
            }
        }

        return $messages;
    }
}
