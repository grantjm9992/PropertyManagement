<?php

namespace App\Classes;

class NotificationLogic extends AdminOU
{
    public static function getUserNotifications()
    {
        //First try for logged user
        $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
        //Next try for user from AJAX request
        $user = ( ( !is_object( $user ) || $user === null )  && isset( $_REQUEST['id'] ) && $_REQUEST['id'] ) ? \App\User::where('id', $_REQUEST['id'] )->first() : null;
        //If neither, return null
        if ( $user === null ) return null;
        return $user->getNotifications();
    }
}
