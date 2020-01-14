<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $fillable = ["id_user", "id_sender", "text", "type", "is_seen"];
    
    public static function getUnseenForUser( $id = null)
    {
        $id = ( is_null( $id ) ) ? $_SESSION['id'] : $id;

        $notifications = self::where('id_user', $id)->where('is_seen', 0)->orderBy("date", "DESC")->get();
        foreach ( $notifications as $notif )
        {
            $sender = \App\User::where('id', $notif->id_sender)->first();
            $notif->sender = (is_object( $sender ) ) ? $sender->user." ".$sender->surname : "";
        }
        return $notifications;        
    }



    
    public static function boot() {
        parent::boot();

        // Once created send email notification
        self::created(function($model){
            $user = User::where("id", $model->id_user)->first();
            if ( is_object( $user ) ) 
            {
                // If user exists and has email. Send
                if ( $user->email != "" )
                {
                  //  \Mail::to( $user->email )->send( new \App\Mail\NewNotification( $model) );       
                }
            }
        });

    }

}
