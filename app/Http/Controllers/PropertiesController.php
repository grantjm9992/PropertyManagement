<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PropertiesController extends BaseController
{

    public function __construct() {
        parent::__construct();
    }
    
    public function defaultAction() {
        $page = \App\Pages::where('id_company', \AppConfig::id_company )->where('id', 3 )->first();
        $this->title = ( $page->meta_title != "" ) ? $page->meta_title : $this->title;
        $this->description = ( $page->meta_description != "" ) ? $page->meta_description : $this->description;
        $this->keywords = ( $page->meta_keywords != "" ) ? $page->meta_keywords : $this->keywords;
        $data = \App\Sections::where('id_page', 3)->get();
        $sections = "";
        $i = 1;
        foreach ( $data as $row )
        {
            $sections .= view('sections/section', array(
                "i" => $i,
                "section" => $row
            ));
            $i++;
        }
        $this->cont->body = "";
        return $this->RenderView();
    }

    public function detailAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to("Properties")->send();
        //$id = base64_decode( $_REQUEST['id'] );
        $id = $_REQUEST["id"];
        $property = \App\Properties::where('id', $id)->first();

        if ( !is_object( $property ) ) return \Redirect::to("Properties")->send();
        $images = \App\PropertiesImages::where("id_property", $id)->get();
        $feateurs = \App\PropertiesFeatures::where("id_property", $id)->get();
        $feats = array();
        foreach ( $feateurs as $row )
        {
            $f = \App\Features::where("id", $row->id_feature)->first();
            $feats[] = $f;
        }

        $resort = \App\Resorts::where("id", $property->id_resort)->first();

        $this->cont->body = view("properties/detail", array(
            "property" => $property,
            "images" => $images,
            "features" => $feats,
            "resort" => $resort
        ));

        return $this->RenderView();
        
    }


    public function getUnavailableDatesAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to("Properties")->send();
        $id = $_REQUEST["id"];
        $reservations = \App\Rentals::where("id_property", $id)->get();
        $res = array();
        foreach ( $reservations as $row )
        {
            $start = new \DateTime( $row->date_start );
            $end = new \DateTime( $row->date_end );
            $start->setTime("12", "00");
            $end->setTime("12", "00");
            while ( $start < $end )
            {
                $res[] = $start->format("d/m/Y");
                $start->modify("+1 days");
            }
        }

        return $res;
    }

    public function getUntiWhenAction()
    {
        $id = $_REQUEST["id"];
        $day = $_REQUEST["date"];
        $day = new \DateTime( $day );
        $day = $day->format("Y-m-d");

        $reservation = \App\Rentals::where("id_property", $id)->whereRaw(" date_start > $day ")->first();
        $until = new \DateTime( $reservation->date_start );

        return $until->format("d/m/Y");
    }

}