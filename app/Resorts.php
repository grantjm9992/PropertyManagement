<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resorts extends Model
{
    protected $fillable = ["name", "description", "longitude", "latitude", "address", "order"];
}
