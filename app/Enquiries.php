<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    protected $fillable = [
        "name", "surname", "email", "subject", "message", "phone", "id_company", "id_apartment"
    ];
}
