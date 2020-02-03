<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtasks extends Model
{
    protected $fillable = [
        "id_task",
        "completed",
        "title",
        "completed_by",
        "date_completed"
    ];


    public function updateOrder($i = null)
    {
        if ( is_null( $i ) )
        {
            $subtasksTask = self::where("id_task", $this->id_task)->get();
            $i = count( $subtasksTask );
        }

        $this->order = $i;
        $this->save();
    }
}
