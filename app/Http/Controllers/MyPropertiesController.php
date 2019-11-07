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
            $html .= view("adminproperties/mypropertycard", array(
                "property" => $home,
                "image" => $image->path
            ));
        }
        $this->cont->body = view("adminproperties/myproperties", array(
            "html" => $html
        ));
        return $this->RenderView();
    }
}