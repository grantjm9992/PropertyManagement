<?php

namespace App\Classes;

class PresetSectionProvider
{
    public $controller;
    
    public function __construct()
    {
        
    }

    public static function propertySliderSplash()
    {
        $properties = \App\Properties::where("id_company", \AppConfig::id_company )->take(3)->get();
        return view("presets/propertySlider", array(
            "properties" => $properties
        ));
    }

    public static function propertySearch()
    {
        $resorts = \App\Resorts::where("id_company", \AppConfig::id_company)->get();
        return view("presets/propertySearch", array(
            "resorts" => $resorts
        ));
    }

    public static function propertyGrid()
    {        
        $properties = \App\Properties::where("id_company", \AppConfig::id_company )->take(6)->get();
        foreach ( $properties as $row )
        {
            $row->images = \App\PropertiesImages::where("id_property", $row->id)->get();
        }
        return view("presets/propertyGrid", array(
            "properties" => $properties
        ));
    }

    public static function testimonialSlider()
    {        /*
        $testimonials = \App\Testimonials::where("id_company", \AppConfig::id_company )->take(5)->get();
        return view("presets/testimonialSlider", array(
            "testimonials" => $testimonials
        ));*/

        return view("presets/testimonialSlider", array(
            
        ));
    }

    public static function contactSection()
    {
        $company = \App\Companies::where("id", \AppConfig::id_company)->first();

        return view("presets/contactSection", array(
            "company" => $company
        ));
    }

    public static function meetAgents()
    {
        //$agents = \App\User::where("id_company", \AppConfig::id_company)->where("role", "M")->first();
        return view("presets/meetAgents", array());
    }
}
