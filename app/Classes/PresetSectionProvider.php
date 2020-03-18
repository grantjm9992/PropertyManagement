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
        $properties = \App\Properties::where("id_company", env('ID_COMPANY') )->where("is_rental", 1)->take(3)->get();
        return view("presets/propertySlider", array(
            "properties" => $properties
        ));
    }

    public static function propertySearch()
    {
        $resorts = \App\Resorts::where("id_company", env('ID_COMPANY'))->get();
        return view("presets/propertySearch", array(
            "resorts" => $resorts
        ));
    }

    public static function propertyGrid()
    {        
        $properties = \App\Properties::select("properties.*", "property_types.title as type")->join("property_types", "properties.id_property_type", "=", "property_types.id")->where("is_rental", 1)->where("id_company", env('ID_COMPANY') )->take(3)->inRandomOrder()->get();
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
        $testimonials = \App\Testimonials::where("id_company", env('ID_COMPANY') )->take(5)->get();
        return view("presets/testimonialSlider", array(
            "testimonials" => $testimonials
        ));*/

        return view("presets/testimonialSlider", array(
            
        ));
    }

    public static function contactSection()
    {
        $company = \App\Companies::where("id", env('ID_COMPANY'))->first();
        
        return view("presets/contactSection", array(
            "company" => $company,
        ));
    }

    public static function meetAgents()
    {
        //$agents = \App\User::where("id_company", env('ID_COMPANY'))->where("role", "M")->first();
        return view("presets/meetAgents", array());
    }
}
