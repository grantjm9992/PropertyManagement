<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresetSectionsPages extends Model
{
    protected $fillable = ["id_preset_section", "id_page", "order"];

    public function updateOrder( $i = null )
    {
        $this->order = $i;
        $this->save();
    }
}
