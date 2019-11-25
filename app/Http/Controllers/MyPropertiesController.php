<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class MyPropertiesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $this->pageTitle = "My Properties";
        $this->iconClass = "fa-home";
        $properties = \App\Properties::where("id_property_owner", $this->user->id)->get();
        $html = "";
        foreach ( $properties as $home )
        {
            $image = \App\PropertiesImages::where("id_property", $home->id)->first();
            if ( !is_object( $image ) )
            {
                $image = new \StdClass();
                $image->path = "images/no-image.jpg";
            }

            $url = \urlencode($this->createURL( $home->id ) );
            $rentals = \App\Rentals::whereRaw(" YEAR(NOW()) = YEAR(date_start) ")->where("id_property", $home->id)->get();
            $tasks = \App\Tasks::where("id_property", $home->id)->where("status", 3)->get();
            $tasksPending = \App\Tasks::where("id_property", $home->id)->where("status", 1)->get();
            $html .= view("adminproperties/mypropertycard", array(
                "property" => $home,
                "image" => $image->path,
                "rentals" => count($rentals),
                "tasks" => count( $tasks ),
                "url" => $url,
                "tasksPending" => count( $tasksPending )
            ));
        }
        $this->cont->body = view("adminproperties/myproperties", array(
            "html" => $html
        ));
        return $this->RenderView();
    }

    protected function createURL( $id, $paid = false )
    {
        $base = url("/");

        $string = "id=".base64_encode( $id );
        if( $paid ) $string .= "&conf=1";

        $string = "?p=".base64_encode( $string );
        return "$base/$string";
    }

    public function detailAction()
    {
        $id = $_REQUEST["id"];
        $property = \App\Properties::where("id", $id)->first();
        $this->botonera = view("myproperties/detailbtn", array(
            "property" => $property
        ));
        $this->cont->body = view("myproperties/detail", array(
            "property" => $property,
            "calendar" => view("comun/rentalcalendar", array(
                "property" => $property
            )),
            "taskcalendar" => view("comun/propertytaskcalendar", array(
                "property" => $property
            ))
        ));
        return $this->RenderView();
    }
}