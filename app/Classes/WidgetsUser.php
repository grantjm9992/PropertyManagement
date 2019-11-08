<?php

namespace App\Classes;

class WidgetsUser extends AdminOU
{
    public $user;

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

    public static function Messages()
    {
        $messages = \App\Messages::getUnreadForUser();
        
    }

    public static function Notifications()
    {
        $notifications = \App\Notifications::getUnseenForUser();

        $ntf = "";
        foreach ( $notifications as $row )
        {
            $ntf .= view(
                "notifications/notificationcard", array(
                    "notification" => $row
                )
            );
        }

        return view("notifications/skeleton", array(
            "notifications" => $ntf
        ));        
    }

    public static function Tasks()
    {
        $user = \UserLogic::getUser();
        $tasks = \App\Tasks::where('id_user', $user->id)->where("status", 1)->orderBy("date_start", "ASC")->take(20)->get();
        $types = array();
        $typeIds = array();
        foreach ( $tasks as $task )
        {
            if ( !in_array( $task->id_type, $typeIds ) )
            {
                $typeIds[] = $task->id_type;
                $type = \App\TaskType::where('id', $task->id_type)->first();
                $types[] = $type;
            }
        }

        $tabs = "";
        $tabinfo = "";
        $i = 0;
        foreach ( $types as $type )
        {
            $tabs .= view("tasks/categoryitem", array(
                "type" => $type,
                "i" => $i
            ));
            $tasks = \App\Tasks::where('id_user', 1)->where("id_type", $type->id)->where("status", 1)->get();
            $tabinfo .= view("tasks/tabitem", array(
                "type" => $type,
                "tasks" => $tasks,
                "i" => $i
            ));
            $i++;
        }
        return view('tasks/skeleton', array(
            "tabs" => $tabs,
            "tabInfo" => $tabinfo
        ));
    }
}
