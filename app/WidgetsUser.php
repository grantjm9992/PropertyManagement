<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WidgetsUser extends Model
{
    protected $table = "widgets_user";
    public static function boot() {
        parent::boot();

    }

    public function updateOrder( $i = null )
    {
        if ( $i === null ) 
        {
            $widgetsUser = self::where('id_user', $_SESSION['id'])->get();
            $this->order = count( $widgetsUser ) + 1;
        }
        else
        {
            $this->order = $i;
        }
        $this->save();
    }
}
