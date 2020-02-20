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
        
        $listings = $this->getListingsAction();
        $resorts = \App\Resorts::get();
        $search = \App\Classes\PresetSectionProvider::propertySearch();

        $this->cont->body = view("properties/index", array(
            "search" => $search,
            "properties" => $listings
        ));

        return $this->RenderView();
    }

    public function getListingsAction()
    {
        $html = "";
        $properties = \App\Properties::whereRaw( $this->makeWhere() )->get();
        foreach( $properties as $row )
        {
            $html .= view("properties/propertycard", array(
                "property" => $row
            ));
        }

        if( $html == "" ) $html = '<div class="alert alert-warning w-100"><i class="fas fa-exclamation"></i>&nbsp;There are no properties that match your search</div>';
        return $html;
    }

    protected function makeWhere()
    {
        $where = " id_company = ".env('ID_COMPANY');

        if ( isset( $_REQUEST["beds"] ) && $_REQUEST["beds"] != "" ) $where .= " AND bed >= ".$_REQUEST["beds"]." ";
        if ( isset( $_REQUEST["sleeps"] ) && $_REQUEST["sleeps"] != "" ) $where .= " AND sleeps >= ".$_REQUEST["sleeps"]." ";
        if ( isset( $_REQUEST["bedrooms"] ) && $_REQUEST["bedrooms"] != "" ) $where .= " AND bedrooms >= ".$_REQUEST["bedrooms"]." ";
        if ( isset( $_REQUEST["id_resort"] ) && $_REQUEST["id_resort"] != "" ) $where .= " AND id_resort = ".$_REQUEST["id_resort"]." ";
        if ( isset( $_REQUEST["id_property_type"] ) && $_REQUEST["id_property_type"] != "" ) $where .= " AND id_property_type = ".$_REQUEST["id_property_type"]." ";
        if ( isset( $_REQUEST["location"] ) && $_REQUEST["location"] != "" ) $where .= " AND location = '".$_REQUEST["location"]."' ";

        return $where;
    }

    public function detailAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to("Properties")->send();
        $id = base64_decode( $_REQUEST['id'] );

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

        $this->cont->body = view("properties/newdetail", array(
            "property" => $property,
            "images" => $images,
            "features" => $feats,
            "resort" => $resort,
            "types" => \App\PropertyTypes::get(),
            "properties" => \App\Properties::orderBy("id", "DESC")->where("id_company", env('ID_COMPANY'))->take(3)->get()
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

    public function getLocationMention()
    {
        $title = $_REQUEST["title"];

        $locations =  DB::table('properties')
        ->select(DB::raw('DISTINCT(location) as location '))
        ->whereRaw(" location LIKE'%$title%' ")
        ->get();
        
        $return = array();
        foreach ( $locations as $row )
        {
            $location = strtoupper( $row->location );
            $location = str_replace(strtoupper($title), strtoupper("<b>$title</b>"), $location);

            $con = array();
            $con["id"] = $row->id;
            $con["title"] = $location;
            array_push($return, $con);
        }
        die(json_encode($return));
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