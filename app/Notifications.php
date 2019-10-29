<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $fillable = ["id_user", "id_sender", "text", "type", "is_seen"];
    
    public static function getUnseenForUser( $id = null)
    {
        $id = ( is_null( $id ) ) ? $_SESSION['id'] : $id;

        $notifications = self::where('id_user', $id)->where('is_seen', 0)->get();
        foreach ( $notifications as $notif )
        {
            $sender = \App\User::where('id', $notif->id_sender)->first();
            $notif->sender = $sender->user." ".$sender->surname;
        }
        return $notifications;        
    }
}
