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



    public static function newTask( $task )
    {
        $notification = new \App\Notifications();
        $notification->id_user = $task->id_user;
        $notification->id_sender = $task->id_created_by;
        $creator = \App\User::where("id", $task->id_created_by)->first();
        $notification->text = ( (int)$task->id_created_by === (int)$task->id_user ) ?  
        "You assigned yourself a&nbsp;<a href='Tasks.edit?id=$task->id'>new task</a>":
        "$creator->name $creator->surname has assigned you a&nbsp;<a href='Tasks.edit?id=$task->id'>new task</a>";
        $notification->save();
    }

    public static function addedArrivalInfo( $reservation )
    {
        $property = \App\Properties::where("id", $reservation->id_property)->first();
        $notification = new \App\Notifications();
        $notification->id_user = $property->id_assigned_to;
        $notification->text = "<a href='Reservations.detail?id=$reservation->id'>The guest for $reservation->date_start for $property->title has added their arrival information</a>";
        $notification->save();
    }

    public static function updateStatusTask( $task )
    {
        $status = ( (int)$task->status === 1 ) ? "pending" : "complete";
        $notification = new \App\Notifications();
        $notification->id_user = $task->id_user;
        $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
        $notification->id_sender = $user->id;
        $notification->text = ( (int)$task->id_user === (int)$user->id ) ?  
        "You marked&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>&nbsp;as $status":
        "$user->name $user->surname marked&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>&nbsp;as $status";
        $notification->save();
        $watchers = \App\TasksWatching::where("id_task", $task->id)->get();
        foreach ( $watchers as $row )
        {
            $notification = new \App\Notifications();
            $notification->id_user = $row->id_user;
            $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
            $notification->id_sender = $user->id;
            $notification->text = ( (int)$row->id_user === (int)$user->id ) ?  
            "You marked&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>&nbsp;as $status":
            "$user->name $user->surname marked&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>&nbsp;as $status";
            $notification->save();
        }
    }

    public static function editTask( $task )
    {
        $notification = new \App\Notifications();
        $notification->id_user = $task->id_user;
        $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
        $notification->id_sender = $user->id;
        $notification->text = ( (int)$task->id_user === (int)$user->id ) ?  
        "You edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>":
        "$user->name $user->surname edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $notification->save();
        $watchers = \App\TasksWatching::where("id_task", $task->id)->get();
        foreach ( $watchers as $row )
        {
            $notification = new \App\Notifications();
            $notification->id_user = $row->id_user;
            $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
            $notification->id_sender = $user->id;
            $notification->text = ( (int)$row->id_user === (int)$user->id ) ?  
            "You edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>":
            "$user->name $user->surname edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>";
            $notification->save();
        }
    } 
}
