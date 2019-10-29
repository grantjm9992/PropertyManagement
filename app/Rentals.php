<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    
    public static function getCalendar( $id_property )
    {
        $rentals = self::where( 'id_property', $id_property )->get();
        $arr = array();
        foreach ( $rentals as $rental )
        {
            $startDate = new \DateTime($rental->date_start);
            $endDate = new \DateTime( $rental->date_end );
            $arr[] = array(
                "id" => $rental->id,
                "start" => $startDate->format('Y-m-d')."T".$startDate->format('H:i:s'),
                "end" => $endDate->format('Y-m-d')."T".$endDate->format('H:i:s'),
                "title" => "Rental from: "
            );
        }

        return $arr;
    }
}
