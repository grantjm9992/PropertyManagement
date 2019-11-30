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

    

    
    public static function boot() {
        parent::boot();

        // Once created, send email notifying all other users in the conversation
        self::created(function($model){
            // Get all users
            $uC = ConversationsUsers::where("id", $model->id_conversation)->get();
            foreach ( $uC as $row )
            {
                //  Don't notify the sender
                if ( (int)$row->id_user !== (int)$model->id_sender )
                {
                    $user = User::where("id", $row->id_user)->first();
                    if ( is_object( $user ) ) 
                    {
                        if ( $user->email != "" )
                        {
                            // If exists and has email. Send
                            Mail::to( $user->email )->send( new \App\Mail\NewNotification( $model) );       
                        }
                    }
                }
            }

        });

    }
}
