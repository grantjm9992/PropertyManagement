<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class WidgetsRoles extends Model
{
    protected $table = "widgets_roles";

    public $incrementing = false;
    
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('id_widget', '=', $this->getAttribute('id_widget'))
            ->where('code_role', '=', $this->getAttribute('code_role'));
        return $query;
    }

}
