<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skins extends Model
{
    protected $fillable = ['id_company', 'c1', 'c2', 'c3', 'c4', 'c5', 't1', 't2', 't3', 't4', 't5', 'logo', 'application_name', "id_header", "version"];
}
