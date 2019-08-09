<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoSections extends Model
{
    protected $fillable = ['name', 'description'];
    
    public function getPagesAttribute()
    {
        $pages = Apartments::where( 'id_info_section', $this->id )->get();
        return count( $pages );
    }
}
