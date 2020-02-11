<?php

namespace App\Classes;

class WidgetsUser extends AdminOU
{

    public static function getWidgets()
    {
        $user = \UserLogic::getUser();
        if ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) 

        $htmlLeft = "";
        $htmlRight = "";/*
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
        }*/
        $appConfig = \App\AppConfig::where("id_user", $user->id)->first();
        if ( is_object( $appConfig ) ) 
        {
            $config = json_decode($appConfig->config);
            foreach ( $config->dashboard->right as $id )
            {
                $widget = \App\Widgets::where('id', $id)->first();
                $execute = $widget->function;
                $htmlRight .= self::$execute($widget);
            }
            foreach ( $config->dashboard->left as $id )
            {
                $widget = \App\Widgets::where('id', $id)->first();
                $execute = $widget->function;
                $htmlLeft .= self::$execute($widget);
            }
        }
        else
        {
            $widgets = \App\WidgetsRoles::where('code_role', $user->role)->orderBy('order', 'ASC')->get();
            foreach ( $widgets as $widgetrole )
            {
                $widget = \App\Widgets::where('id', $widgetrole->id_widget)->first();
                $execute = $widget->function;
                if ( $widgetrole->side == "R" )
                {
                    $htmlRight .= self::$execute($widget);
                }
                else
                {
                    $htmlLeft .= self::$execute($widget);
                }
                
            }
        }

        return array($htmlLeft, $htmlRight);
    }

    public static function Messages($widget)
    {
        $messages = \App\Messages::getUnreadForUser();
        
    }

    public static function teamTaskCalendar($widget)
    {
        $user = \UserLogic::getUser();
        return view('widgets/team-calendar', array(
            "user" => $user,
            "widgetId" => $widget->id
        ));
    }

    public static function Notifications($widget)
    {
        $notifications = \App\Notifications::getUnseenForUser();
        $user = \UserLogic::getUser();
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
            "notifications" => $ntf,
            "widgetId" => $widget->id
        ));        
    }

    public static function myPropertyCalendar($widget)
    {
        $user = \UserLogic::getUser();
        return view('widgets/property-owner-calendar', array(
            "user" => $user,
            "widgetId" => $widget->id
        ));
    }

    public static function propertyInformation($widget)
    {
        $user = \UserLogic::getUser();
        $property = \App\Properties::where("id_property_owner", $user->id)->orderBy("information_complete", "ASC")->first();
        return view("adminproperties/informationprogress", array(
            "property" => $property,
            "widgetId" => $widget->id
        ));
    }

    public static function getMyCalendar($widget)
    {
        return view('tasks/calendarskeleton', array(
            "widgetId" => $widget->id
        ));
    }

    public static function getMyPropertyCalendar()
    {
        
    }

    public static function getMyPropertyRentalCalendar()
    {
        
    }

    public static function Tasks($widget)
    {
        $user = \UserLogic::getUser();
        $tasks = \App\Tasks::join("tasks_users", "tasks_users.id_task", "=", "tasks.id")->where("tu_id_user", $user->id)->where("status", 1)->where("archived", 0)->orderBy("date_start", "ASC")->take(20)->get();
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
            $tasks = \App\Tasks::join("tasks_users", "tasks.id", "=", "tasks_users.id_task")->where("tu_id_user", $user->id )->where("id_type", $type->id)->where("status", 1)->get();
            $tabinfo .= view("tasks/tabitem", array(
                "type" => $type,
                "tasks" => $tasks,
                "i" => $i
            ));
            $i++;
        }
        return view('tasks/skeleton', array(
            "tabs" => $tabs,
            "tabInfo" => $tabinfo,
            "widgetId" => $widget->id
        ));
    }


    public static function directMessage($widget)
    {        
        $user = \UserLogic::getUser();
        $conversationHTML = "";
        $conversations = \App\ConversationsUsers::where('id_user', $user->id )->orderBy('last_message', 'DESC')->get();
        foreach ( $conversations as $row )
        {
            $conversation = \App\Conversations::where('id', $row->id_conversation)->first();
            $conversation->getForCard();
            $conversationHTML .= view('widgets/direct-chat-contact', array(
                "message" => $conversation,
                "user" => $user
            ));
        }

        $lastConversation = \App\Conversations::getLastForUser();
        $messages = \App\Messages::where("id_conversation", $lastConversation->id_conversation)->orderBy("date_sent", "ASC")->get();
        $html = "";
        foreach ( $messages as $message )
        {
            if ( (int)$user->id !== (int)$message->id_sender )
            {
                $message->is_read = 1;
                $message->save();
            }
            $message->image = "img/user.png";
            $sender = \App\User::where("id", $message->id_sender)->first();
            $html .= view("widgets/direct-chat-message", array(
                "sender" => $sender,
                "message" => $message,
                "user" => $user
            ));
        }

        return view("widgets/direct-chat", array(
            "conversations" => $conversationHTML,
            "messages" => $html
        ));
    }

    
    public function defaultAction($widget) {
        $convo = ( isset( $_REQUEST["id"] ) && $_REQUEST["id"] != "" ) ? $this->getConversationAction() : "";
        $this->pageTitle = "Messages";
        $this->iconClass = "fa-envelope";
        $this->cont->body = view('messages/index', array(
            "conversations" => $this->conversationsAction(),
            "conversation" => $convo
        ));
        return $this->RenderView();
    }

    public function conversationsAction()
    {
        $conversationHTML = "";
        $conversations = \App\ConversationsUsers::where('id_user', $this->user->id )->orderBy('last_message', 'DESC')->get();
        foreach ( $conversations as $row )
        {
            $conversation = \App\Conversations::where('id', $row->id_conversation)->first();
            $conversation->getForCard();
            $conversationHTML .= view('widgets/direct-chat-contact', array(
                "message" => $conversation,
                "user" => $this->user
            ));
        }

        return $html;
    }
}
