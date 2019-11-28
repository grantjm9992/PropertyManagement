<?php

namespace App\Classes;

class UserLogic extends AdminOU
{
    
    public static function getUser( $id = null )
    {
        $user = ( $id === null ) ? \App\User::where('id', $_SESSION['id'])->first() : \App\User::where('id', $id)->first();

        return $user;
    }

    public static function getUserId( $user = null )
    {
        $user = ( $user === null ) ? \App\User::where('id', $_SESSION['id'])->first() : $user;

        return (int)$user->id;
    }
}
