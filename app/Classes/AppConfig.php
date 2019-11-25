<?php

namespace App\Classes;

class AppConfig
{
    const id_company = "-1";
    
    public function __construct()
    {
        
    }

    public static function canView($type, $element)
    {
        switch( $type )
        {
            case "TASK":
                return self::canViewTask( $element );
                break;
                case "RENTAL":
                    return self::canViewRental( $element );
                    break;
                    case "PROPERTY":
                        return self::canViewProperty( $element );
                        break;
                        case "USER":
                            return self::canViewUser( $element );
                            break;
                            case "NOTIFICATION":
                                return self::canViewNotification( $element );
                                break;
        }
    }

    public static function canViewTask( $task )
    {
        $response = false;
        $user = \UserLogic::getUser();
        if ( $user->role == "SA" ) $response = true;
        if ( (int)$task->id_company === (int)$user->id_company && $user->role == "AA"  ) $response = true;
        if ( (int)$task->id_created_by === (int)$user->id ) $response = true;
        if ( (int)$task->id_user === (int)$user->id ) $response = true;
        if ( (int)$task->id_property != "" )
        {
            $property = \App\Properties::where( "id", $task->id_property )->first();
            if ( is_object( $property ) )
            {
                if ( (int)$property->id_property_owner === (int)$user->id ) $response = true;
            }
        }
        return $response;
    }

    public static function canEdit($type, $element)
    {
        switch( $type )
        {
            case "TASK":
                return self::canEditTask( $element );
                break;
                case "RENTAL":
                    return self::canEditRental( $element );
                    break;
                    case "PROPERTY":
                        return self::canEditProperty( $element );
                        break;
                        case "USER":
                            return self::canEditUser( $element );
                            break;
                            case "NOTIFICATION":
                                return self::canEditNotification( $element );
                                break;
        }
    }

    public static function canEditTask( $task )
    {
        $response = false;
        $user = \UserLogic::getUser();
        if ( $user->role == "SA" ) $response = true;
        if ( $task->id_created_by === $user->id ) $response = true;
        if ( $task->id_user === $user->id ) $response = true;

        return $response;
    }

}
