<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'type', 'phone'];
}
