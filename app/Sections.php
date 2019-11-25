<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table = "sections";
    protected $fillable = ["title", "subtitle", "description", "id_page", "order", "button", "button_text", "button_link"];

    public static function boot()
    {
        parent::boot();
        self::created( function( $section ){
            return $section->updateOrder();
        });
    }

    public function updateOrder( $i = null )
    {
        if ( $i === null )
        {
            $sections = self::where('id_page', $this->id_page)->get();
            $i = count( $sections );
        }
        $this->order = $i;
        $this->save();
    }
}
