<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesImages extends Model
{
    public function updateOrder($i = null) {
        if (is_null($i)) {
            $id = $_REQUEST['id'];
            $features = self::where("id_property", $id)->get();
            $i = count($features);
        }
        $this->order = $i;
        $this->save();
    }
}
