<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class ResortsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $this->pageTitle = "Properties";
        $this->iconClass = "fa-home";
        $this->botonera = '<div onclick="newResort()" class="btn btn-primary"><i class="fas fa-plus"></i> New resort</div>';
        $resort_html = "";
        $resorts = \App\Resorts::where('id_company', $this->user->id_company)->orderBy('order')->get();
        foreach ( $resorts as $resort )
        {
            $resort_html .= view('resorts/resort_div', array(
                "resort" => $resort
            ));
        }
        $this->cont->body = view('resorts/index', array(
            "resorts" => $resort_html
        ));;
        return $this->RenderView();
    }

    public function detailAction()
    {
        $id = $_REQUEST["id"];
        $resort = \App\Resorts::where("id", $id)->first();
        $sections = \App\ResortsSections::where("id_resort", $id)->get();
        $sectionHTML = "";
        foreach ( $sections as $section )
        {
            $sectionHTML .= view('sections/page_div', array(
                "page" => $section
            ));
        }

        $img = ( file_exists( $page->image ) ) ? 1 : 0;

        $this->cont->body = view('resorts/detail', array(
            "page" => $page,
            "sections" => $sectionHTML,
            "image" => $img          
        ));
    }

    
    public function listadoAction()
    {
        $this->data = \App\Resorts::where("id_company", $this->user->id_company )->get();
        $this->campos[] = array(
            "title"=> "Name",
            "name" => "name"
        );
        $this->detailURL = "Resorts.detail?id=";
        return $this->createTable();
    }

    public function newAction()
    {
        $resort = new \App\Resorts();
        $resort->id_company = $this->user->id_company;
        $resort->save();
        return view(
            "resorts/resort_div", array(
                "resort" => $resort
            )
        );
    }

    public function updateAction()
    {
        $id = $_REQUEST["id"];
        $name = $_REQUEST["name"];
        $resort = \App\Resorts::where("id", $id)->first();
        $resort->name = $name;
        $resort->save();
        return "OK";
    }
}