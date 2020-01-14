<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class SectionsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        
    }

    public function deleteAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return "OK";
        $section = \App\Sections::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $section ) ) return "OK";
        /*$trads = \App\TradsSections::where('id_section', $section->id)->get();
        foreach ( $trads as $trad )
        {
            $trad->delete();
        }*/
        $section->delete();
        return "OK";
    }

    public function deletePresetAction()
    {
        $id = $_REQUEST["id"];
        $id_page = $_REQUEST["id_page"];
        $pre = \App\PresetSectionsPages::where("id_page", $id_page)->where("id_preset_section", $id)->first();
        $pre->delete();
        return "OK";
    }

    public function updateOrderAction()
    {
        $id_page = $_REQUEST["id"];
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            if ( strpos( $id , "preset_" ) > -1 )
            {
                $id_preset_section = substr($id, strpos($id, "_") + 1 );
                $section = \App\PresetSectionsPages::where("id_page", $id_page)->where("id_preset_section", $id_preset_section)->first();
                $section->updateOrder( $i );
            }
            else
            {
                $section = \App\Sections::where('id', $id)->first();
                $section->updateOrder( $i );
            }
            $i++;
        }
    }

    public function itemAction()
    {
        $sectionHTML = "";
        $this->pageTitle = "Edit section";
        $this->iconClass = "fas fa-";
        $id = $_REQUEST['id'];
        $section = \App\Sections::where('id', $id)->first();
        $this->botonera = view('sections/editbuttons', array(
            "section" => $section
        ));
        $img = ( file_exists( $section->image ) ) ? 1 : 0;
        $this->cont->body = view('sections/detail', array(
            "section" => $section,
            "image" => $img
        ));
        return $this->RenderView();
    }

    
    public function getSectionAction()
    {
        $id = $_REQUEST["id"];
        $section = \App\Sections::where("id", $id)->first();
        return json_encode($section);
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'];
        $section = \App\Sections::where('id', $id)->first();
        $section->title = $_REQUEST['name'];
        $section->save();
        return "OK";
    }

    public function saveAction()
    {
        $page = \App\Sections::where('id', $_REQUEST['id'])->first();
        $page->update($_REQUEST);
        return \Redirect::to("Pages.item?id=$page->id_page")->send();
    }

    public function newAction()
    {
        $section = \App\Sections::create($_REQUEST);
        $section->id_company = \AppConfig::id_company;
        $section->save();
        return view('sections/page_div', array(
            "page" => $section
        ));
    }
    
    public function removeImageAction()
    {
        $id = $_REQUEST['id'];
        $section = \App\Sections::where('id', $id)->first();

        unlink( $section->image );
        $section->image = null;
        $section->save();
        return "OK";
    }

    public function uploadImageAction()
    {
        if (!empty($_FILES)) {
            
            /**
             * Save file
             */
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];
            $targetDir = "img/sections/$id/";
            if (!is_dir( $targetDir ) )
            {
                mkdir( $targetDir, 0777, true );
            }
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            
            $targetFile = "$targetDir"."$id.".$ext;
            move_uploaded_file($tempFile , $targetFile);

            /**
             * Update page file
             */
            $page = \App\Sections::where('id', $id)->first();            
            $page->image = $targetFile;
            $page->save();
        }

        return "OK";
    }

    public function newPresetModalAction()
    {
        $id_page = $_REQUEST["id_page"];
        $presets = \App\PresetSections::whereRaw("id NOT IN (SELECT id_preset_section FROM preset_sections_pages WHERE id_page = $id_page )")->get();
        return view("modal/presets", array(
            "presets" => $presets,
            "id_page" => $id_page
        ));
    }

}