<?php

namespace App\Classes;

class WidgetsUser extends AdminOU
{

    public static function getWidgets()
    {
        if ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) $user = \UserLogic::getUser();

        $html = "";
        $personal = \App\WidgetsUser::where('id_user', $user->id )->orderBy('order', 'ASC')->get();
        if ( count( $personal ) > 0 )
        { 
            foreach ( $personal as $row )
            {
                $widget = \App\Widgets::where('id', $row->id_widget )->first();
                $execute = $widget->function;
                $html .= self::$execute();
            }
        }
        else
        {
            $widgets = \App\WidgetsRoles::where('code_role', $user->role)->orderBy('order', 'ASC')->get();
            foreach ( $widgets as $widgetrole )
            {
                $widget = \App\Widgets::where('id', $widgetrole->id_widget)->first();
                $execute = $widget->function;

                $html .= self::$execute();
            }
        }

        return $html;
    }
    
    public static function RentalsAdminArea()
    {

        return view('widgets/rentalsadminarea', array(

        ));
    }

    public static function Messages()
    {
        $messages = \App\Messages::getUnreadForUser();

        return view('widgets/messages', array(
            "messages" => $messages
        ));
    }

    public static function Notifications()
    {
        $notifications = \App\Notifications::getUnseenForUser();

        return view('widgets/notifications', array(
            "notifications" => $notifications
        ));
    }
}
