<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    public function updateOrder($i = null) {
        if (is_null($i)) {
            $features = self::get();
            $i = count($features);
        }
        $this->order = $i;
        $this->save();
    }
}
