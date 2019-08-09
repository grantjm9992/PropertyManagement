<?php

namespace App\Classes;

class UserLogic extends AdminOU
{
    
    public static function getUser( $id = null )
    {
        $user = ( $id === null ) ? \App\User::where('id', $_SESSION['id'])->first() : \App\User::where('id', $id)->first();

        return $user;
    }
}
