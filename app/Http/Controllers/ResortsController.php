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
            $sectionHTML .= view('resorts/resortsection_div', array(
                "section" => $section
            ));
        }

        $img = ( file_exists( $resort->image ) ) ? 1 : 0;

        $this->cont->body = view('resorts/detail', array(
            "resort" => $resort,
            "sections" => $sectionHTML,
            "image" => $img          
        ));

        return $this->RenderView();
    }

    public function uploadSectionImageAction()
    {
        $id = $_REQUEST["id"];
        $section = \App\ResortsSections::where("id", $id)->first();
    }


    public function sectionDetailAction()
    {
        $sectionHTML = "";
        $this->pageTitle = "Edit section";
        $this->iconClass = "fas fa-";
        $id = $_REQUEST['id'];
        $section = \App\ResortsSections::where('id', $id)->first();
        $this->botonera = view('resorts/sectioneditbuttons', array(
            "section" => $section
        ));
        $img = ( file_exists( $section->image ) ) ? 1 : 0;
        $this->cont->body = view('resorts/sectiondetail', array(
            "section" => $section,
            "image" => $img
        ));
        return $this->RenderView();
    }

    public function newSectionAction()
    {
        $section = \App\ResortsSections::create($_REQUEST);
        return view('resorts/resortsection_div', array(
            "section" => $section
        ));
    }

    public function deleteSectionAction()
    {
        $id = $_REQUEST["id"];
        $rs = \App\ResortsSections::where("id", $id)->first();
        $rs->delete();
        if ( \file_exists( $rs->image ) ) \unlink( $rs->image );

        return "OK";
    }

    public function updateSectionAction()
    {
        $id = $_REQUEST["id"];
        $rs = \App\ResortsSections::where("id", $id)->first();
        $rs->title = $_REQUEST["name"];
        $rs->update();
        return "OK";
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
    

    public function uploadLocalAttractionsAction() 
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];

            $targetDir = "data/resorts/$id/";
            if (!is_dir( $targetDir ) )
            {
                mkdir( $targetDir, 0777, true );
            }
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $path = $targetDir."localattractions.".$ext;
            move_uploaded_file($tempFile , $path);
        }
        return "OK";
    }

    public function downloadLocalAttractionsAction() 
    {
        $id = $_REQUEST["id"];
        $resort = \App\Resorts::where("id", $id)->first();
        header('Content-Disposition: attachment; filename;"local_attraction_information_'.$resort->name.'.json";');
        header('Content-type: application/json');
        if ( file_exists( "data/resorts/$id/localattractions.json" ) )
        {
            $csv = "";
            $file = \file_get_contents("data/resorts/$id/localattractions.json");
            die($file);
        }

    }
}