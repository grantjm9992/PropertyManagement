<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;


class HomeController extends BaseController
{

    const ADMIN = array(
        "phisoluciones.es@gmail.com"
    );

    public function __construct() {
        $this->headerClass = "";
        parent::__construct();
        $this->bodyClass = "body";
    }
    
    public function defaultAction() {
        if ( isset( $_REQUEST["p"] ) && $_REQUEST["p"] != "" ) return $this->isEncoded();
        
        $this->cont->body = view('home/index', 
            array(
        ));
        return $this->RenderView();
    }

    protected function isEncoded()
    {
        $enocdedString = $_REQUEST["p"];
        $string = base64_decode( $enocdedString );
        parse_str( $string, $paramArray );
        $arrivalForm = "";
        $arrivalForm = ( array_key_exists( "conf", $paramArray ) && $paramArray["conf"] == "1" && !array_key_exists("added", $paramArray ) ) ? view("properties/arrival_form", array("id_reserva" => $paramArray["id_reserva"], "p" => $enocdedString ) ) : "";

        $id = \base64_decode( $paramArray["id"] );
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
            "resort" => $resort,
            "arrivalForm" => $arrivalForm
        ));
        $this->cont->header = "";
        $this->cont->footer = "";
        return $this->RenderView();
    }

    public function addArrivalAction()
    {
        $id = base64_decode( $_REQUEST["id"] );
        $reservation = \App\Rentals::where("id", $id)->first();
        $reservation->arrival_time = $_REQUEST["arrival_time"];
        $reservation->arrival_notes = $_REQUEST["arrival_notes"];
        $reservation->save();
        \NotificationLogic::addedArrivalInfo( $reservation );
        $base = url("/");

        $string = "id=".base64_encode( $reservation->id_property );
        $string = "?p=".base64_encode( $string );
        return \Redirect::to("$base/$string")->send();        
    }

    public function registerInterestAction()
    {
        $date = new \DateTime();
        $enq = \App\Enquiries::create( $_REQUEST );
        $enq->date_joined = $date->format('Y-m-d H:i:s');
        $enq->save();
    
        $apt = ( isset( $_REQUEST['id_apartment'] ) && $_REQUEST['id_apartment'] != "" ) ? \App\Apartments::where('id', $_REQUEST['id_apartment'])->first() : null;

        $template = view('mail/enquiries', array(
            "enq" => $enq,
            "apt" => $apt
        ));
        
        //\Mail::to ( self::ADMIN )->send( new \App\Mail\Enquiry( $enq, $apt ) );
        
        return "OK";
    }

    public function registerModalAction()
    {
        return view('modal/register');
    }

    public function registerAction()
    {
        $date = new \DateTime();
        $enq = \App\Enquiries::create( $_REQUEST );
        $enq->date_joined = $date->format('Y-m-d H:i:s');
        $enq->save();
    
        $apt = ( isset( $_REQUEST['id_apartment'] ) && $_REQUEST['id_apartment'] != "" ) ? \App\Apartments::where('id', $_REQUEST['id_apartment'])->first() : null;

        $template = view('mail/enquiries', array(
            "enq" => $enq,
            "apt" => $apt
        ));
        
        \Mail::to ( self::ADMIN )->send( new \App\Mail\Enquiry( $enq, $apt ) );
        return \Redirect::to('/')->send();
    }

    protected function panelForCategory( $cat, $class )
    {
        $items = MenuItems::where('id_category', $cat->id)->orderBy('order', 'ASC')->get();
        $left = "";
        $right = "";
        $i = 0;
        foreach ( $items as $row )
        {
            if ( !file_exists( $row->image ) ) $row->image = "images/nophoto.png";
            if ( $i % 2 )
            {
                $right .= view('home/item', array(
                    "item" => $row
                ));
            }
            else
            {
                $left .= view('home/item', array(
                    "item" => $row
                ));
            }
            $i++;
        }

        return view('home/panel', array(
            "left" => $left,
            "right" => $right,
            "active" => $class,
            "cat" => $cat
        ));
    }

    public function acceptCookiesAction()
    {
        setcookie("the_resorts_92", "1");
    }

    public function changeLanguageAction()
    {
        if ( isset( $_REQUEST['locale'] ) && $_REQUEST['locale'] != "" )
        {
            TranslationProvider::_setLocale( $_REQUEST["locale"] );
        }
        return "OK";
    }
}