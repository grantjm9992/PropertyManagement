<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{

    protected $fillable = [
        "id_property", "name", "surname", "email", "phone", "date_start", "date_end", "is_confirmed", "id_type"
    ];
    
    public static function getForCalendar( $id_property )
    {
        $rentals = self::where( 'id_property', $id_property )->get();
        $arr = array();
        foreach ( $rentals as $row )
        {
            $start = new \DateTime( $row->date_start );
            $end = new \DateTime( $row->date_end );
            $hour = "16";
            $minute = "00";
            if ( $row->arrival_time != "" ) 
            {
                $timeArr = explode( ":", $row->arrival_time );
                $hour = $timeArr[0];
                $minute = $timeArr[1];
                if ( \strpos($minute, "pm") > -1 ) $hour += 12;
                $minute = \substr($minute, 0, \strlen($minute) - 3);
            }
            $start->setTime($hour, $minute);
            $end->setTime("11", "00");
            $arr[] = array(
                "title" => "Rental: $row->name $row->surname",
                "start" => $start->format("Y-m-d")."T".$start->format("H:i:s"),
                "end" => $end->format("Y-m-d")."T".$end->format("H:i:s"),
                "color" => "#5816a0",
                "textColor" => "#fff"
            );
        }

        return $arr;
    }

    
    
    public static function getCalendar( $id_property )
    {
        $rentals = self::where( 'id_property', $id_property )->get();

        return $rentals;
    }
}
