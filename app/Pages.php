<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = "pages";
    protected $fillable = ["id_company", "active", "order", "url", "menu_title", "include_slider", "slider_title", "slider_subtitle", "slider_image", "slider_txt_button", "page_title", "page_image", "slider_on_page", "meta_title", "meta_description", "meta_keywords"];


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
