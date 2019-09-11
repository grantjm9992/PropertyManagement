<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $fillable = ['id_resort',
                            'id_company',
                            'id_created_by',
                            'id_area', 
                            "id_assigned_to",
                            "id_property_owner",
                            "id_property_type",
                            "title",
                            "description",
                            "price",
                            "sleeps",
                            "bedrooms",
                            "bed",
                            "bath",
                            "location",
                            "id_info_section"];


    public function isEmpty()
    {
        return true;
    }
}
