<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyTypes extends Model
{
    
    public static function boot() {
        parent::boot();

        self::retrieved(function($model){
        });

        self::updating(function($model){
            unset($model->total);
        });
        self::creating(function($model){
            unset($model->total);
        });

    }
}
