<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    

    public static function getUnreadForUser($id = null)
    {
        $id = ( is_null( $id ) ) ? $_SESSION['id'] : $id;

        $messages = self::where('id_receiver', $id)->where('is_read', 0)->get();
        if ( count( $messages ) === 0 ) return null;
        foreach ( $messages as $message )
        {
            $sender = \App\User::where('id', $message->id_sender)->first();
            $message->sender = $sender->user." ".$sender->surname;
            $message->avatar = ( file_exists( $sender->img ) ) ? $sender->img : "img/user.png";
        }
        return $messages;
    }
}
