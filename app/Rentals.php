<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{

    protected $fillable = [
        "id_property", "name", "surname", "email", "phone", "date_start", "date_end"
    ];
    
    public static function getCalendar( $id_property )
    {
        $rentals = self::where( 'id_property', $id_property )->get();

        return $rentals;
    }
}
