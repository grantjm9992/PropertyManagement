<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ["id_user", "id_created_by", "completed", "id_company", "id_property", "id_reservation", "id_type", "title", "description", "date_start", "date_end", "status"];

    public static function getForUser( $id_user )
    {
        
        $tasks = self::where('id_user', $id_user )->whereRaw( self::makeWhere() )->orderBy('date_start', 'ASC')->get();
        foreach ( $tasks as $task )
        {
            $task->creator = User::where("id", $task->id_created_by )->first();
        }

        return $tasks;
    }

    public static function getUpcomingForUser( $id_user )
    {
        $task = self::where("id_user", $id_user )->whereRaw("date_start > NOW() " )->orderBy("date_start", "ASC")->get();
        foreach ( $tasks as $task )
        {
            $task->creator = User::where("id", $task->id_created_by )->first();
        }

        return $tasks;
    }

    public static function getPendingForUser( $id_user )
    {
        $task = self::where("id_user", $id_user )->where("status", 1 )->orderBy("date_start", "ASC")->get();
        foreach ( $tasks as $task )
        {
            $task->creator = User::where("id", $task->id_created_by )->first();
        }

        return $tasks;
    }

    public static function getPropertyCalendar( $property )
    {
        $tasks = self::where("id_property", $property->id)->get();
        $arr = array();
        foreach ( $tasks as $row )
        {
            $start = new \DateTime( $row->date_start );
            $end = new \DateTime( $row->date_end );
            switch( (int)$row->status )
            {
                case 1:
                    $colour = "#fb8c00";
                    $textColour = "#fff";
                break;
                case 2:
                case 3:
                    $colour = "#55b559";
                    $textColour = "#fff";
                break;
            }
            $arr[] = array(
                "id" => $row->id,
                "title" => "$row->title",
                "color" => $colour,
                "textColor" => $textColour,
                "start" => $start->format("Y-m-d")."T".$start->format("H:i:s"),
                "end" => $end->format("Y-m-d")."T".$end->format("H:i:s")
            );
        }
        return $arr;

    }

    public static function getMyCalendar()
    {
        $tasks = self::where("id_user", \UserLogic::getUserId() )->get();
        $arr = array();
        foreach ( $tasks as $row )
        {
            $start = new \DateTime( $row->date_start );
            $end = new \DateTime( $row->date_end );
            switch( (int)$row->status )
            {
                case 1:
                    $colour = "#fb8c00";
                    $textColour = "#fff";
                break;
                case 2:
                case 3:
                    $colour = "#55b559";
                    $textColour = "#fff";
                break;
            }
            $arr[] = array(
                "id" => $row->id,
                "title" => "$row->title",
                "color" => $colour,
                "textColor" => $textColour,
                "start" => $start->format("Y-m-d")."T".$start->format("H:i:s"),
                "end" => $end->format("Y-m-d")."T".$end->format("H:i:s")
            );
        }
        return $arr;

    }
    

    public static function getMyTeam()
    {
        $user = \UserLogic::getUser();
        $task = self::where("id_company", $user->id_company )->orderBy("date_start", "ASC")->get();
        foreach ( $tasks as $task )
        {
            $task->creator = User::where("id", $task->id_created_by )->first();
        }

        return $tasks;
    }

    public static function makeWhere()
    {
        $where = " 1 ";
//        if ( !isset( $_REQUEST["pp"] ) ) $where .= " AND ( date_start > NOW() OR date_start IS NULL ) ";
        if ( isset( $_REQUEST["id_type"] ) && $_REQUEST["id_type"] != "" ) $where .= " AND id_type = ".$_REQUEST["id_type"];
        if ( isset( $_REQUEST["status"] ) && $_REQUEST["status"] != "" ) $where .= " AND status = ".$_REQUEST["status"];
        if ( isset( $_REQUEST["id_company"] ) && $_REQUEST["id_company"] != "" ) $where .= " AND id_company = ".$_REQUEST["id_company"];
        if ( isset( $_REQUEST["id_property"] ) && $_REQUEST["id_property"] != "" ) $where .= " AND id_property = ".$_REQUEST["id_property"];
        if ( isset( $_REQUEST["id_user"] ) && $_REQUEST["id_user"] != "" ) $where .= " AND id_user = ".$_REQUEST["id_user"];
        if ( isset( $_REQUEST["pp"] ) && $_REQUEST["pp"] == "1" ) $where .= " AND date_start < NOW() ";
        if ( isset( $_REQUEST["pp"] ) && $_REQUEST["pp"] == "all" ) $where .= "  ";


        return $where;
    }
}