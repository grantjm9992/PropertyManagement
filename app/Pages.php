<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = "pages";
    protected $fillable = ["name", "image", "description", "meta_keywords", "meta_description", "meta_title", "image"];


    public function updateOrder( $i = null )
    {
        $this->order = $i;
        $this->save();
    }

    public function getSections()
    {
        return Sections::where('id_page', $this->id)->orderBy('order', 'ASC')->get();
    }
}
