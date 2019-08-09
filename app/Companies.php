<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = ['application_url', 'name'];

    public function isEmpty()
    {

        return true;
    }
}
