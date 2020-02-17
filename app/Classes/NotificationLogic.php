<?php

namespace App\Classes;

class NotificationLogic extends AdminOU
{

    public $now;

    public function __construct()
    {
    }
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

    protected static function now()
    {
        
        $date = new \DateTime();
        return $date->format("Y-m-d H:i:s");
    }



    public static function newTask( $task )
    {
        $notification = new \App\Notifications();
        $notification->date = self::now();
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
        $notification->date = self::now();
        $notification->id_user = $property->id_assigned_to;
        $notification->text = "<a href='Reservations.detail?id=$reservation->id'>The guest for $reservation->date_start for $property->title has added their arrival information</a>";
        $notification->save();
    }

    public static function updateStatusTask( $task )
    {
        $status = ( (int)$task->status === 1 ) ? "pending" : "complete";
        $notification = new \App\Notifications();
        $notification->date = self::now();
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
            $notification->date = self::now();
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
        $notification->date = self::now();
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
            $notification->date = self::now();
            $notification->id_user = $row->id_user;
            $user = ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) ? \App\User::where('id', $_SESSION['id'])->first() : null;
            $notification->id_sender = $user->id;
            $notification->text = ( (int)$row->id_user === (int)$user->id ) ?  
            "You edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>":
            "$user->name $user->surname edited&nbsp;<a href='Tasks.edit?id=$task->id'>$task->title</a>";
            $notification->save();
        }
    } 

    /**
     * ACTIVITY LOGS
     */
    

    public static function logNewTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> created the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logEditTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> edited the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logCompletedTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> completed the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logUploadedToTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> uploaded files to the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logAddedSubtaskTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> added a subtask to <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logCompletedSubtaskTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> completed subtask of <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logDeletedTask( $task )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> deleted the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->save();
    }

    public static function logCommentedTask( $task, $task_comment )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> commented the task <a href='Tasks.edit?id=$task->id'>$task->title</a>";
        $log->detail = $task_comment->comment;
        $log->save();
    }


    public static function logNewProperty( $property )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> created the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }


    public static function logEditProperty( $property )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> edited the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }


    public static function logDeleteProperty( $property )
    {
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> deleted the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }


    public static function logNewReservation( $reservation )
    {
        $property = \App\Properties::where("id", $reservation->id_property)->first();
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> created the reservation for the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }


    public static function logEditReservation($reservation )
    {
        $property = \App\Properties::where("id", $reservation->id_property)->first();
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> edited a reservation for the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }


    public static function logDeleteReservation( $reservation )
    {
        $property = \App\Properties::where("id", $reservation->id_property)->first();
        $log = new \App\Log();
        $log->date = self::now(); $log->id_user = $_SESSION["id"];
        $creator = \App\User::where("id", $_SESSION["id"])->first();
        $log->text = "<a href='Profile?id=$creator->id'>$creator->name $creator->surname</a> deleted a reservation for the property <a href='AdminProperties.detail?id=$property->id'>$property->title</a>";
        $log->save();
    }

}
