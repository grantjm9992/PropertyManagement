<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResortsSections extends Model
{
    protected $fillable = ["id_resort", "title", "subtitle", "description", "image", "button", "button_text", "button_link"];
}
