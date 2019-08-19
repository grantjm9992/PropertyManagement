<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    
    public static function getUnseenForUser( $id = null)
    {
        $id = ( is_null( $id ) ) ? $_SESSION['id'] : $id;

        $notifications = self::where('id_user', $id)->where('is_seen', 0)->get();
        if ( count( $notifications ) === 0 ) return null;
        foreach ( $notifications as $notif )
        {
            $sender = \App\User::where('id', $notif->id_sender)->first();
            $notif->sender = $sender->user." ".$sender->surname;
        }
        return $notifications;        
    }
}
