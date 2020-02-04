<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $table = "task_type";
    protected $fillable = ["description", "menu", "colour", "text_colour"];
}
