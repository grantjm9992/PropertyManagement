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
        $customSections = Sections::where('id_page', $this->id)->orderBy('order', 'ASC')->get();
        $presetSections = PresetSectionsPages::where("id_page", $this->id )->orderBy("order", "ASC")->get();
        $arr = array();
        foreach ( $customSections as $row )
        {
            $arr[] = $row;
        }
        foreach ( $presetSections as $row )
        {
            $arr[] = $row;
        }
        usort($arr, function ($item1, $item2) {
            return $item1->order <=> $item2->order;
        });

        return $arr;
    }
}
