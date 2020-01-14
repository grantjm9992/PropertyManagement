<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PagesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        $this->pageTitle = "Pages";
        $this->iconClass = "fas fa-sticky-note";
        $page_html = "";
        $pages = \App\Pages::where("id_company", $this->user->id_company)->orderBy('order')->get();
        foreach ( $pages as $page )
        {
            $page_html .= view('pages/page_div', array(
                "page" => $page
            ));
        }
        $this->cont->body = view('pages/index', array(
            "pages" => $page_html
        ));;
        return $this->RenderView();
    }

    public function updateOrderAction()
    {
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            $page = \App\Pages::where('id', $id)->first();
            $page->updateOrder( $i );
            $i++;
        }
        return "OK";
    }

    public function itemAction()
    {
        $id_page = $_REQUEST["id"];
        $sectionHTML = "";
        $this->pageTitle = "Edit page";
        $this->iconClass = "fas fa-sticky-note";
        $this->botonera = view('pages/editbuttons');
        $id = $_REQUEST['id'];
        if ( (int)$id === -1 ) return $this->editHomePage();
        $page = \App\Pages::where('id', $id)->first();
        $sections = $page->getSections();
        foreach ( $sections as $section )
        {
            if ( is_null( $section->id_preset_section ) )
            {
                $sectionHTML .= view('sections/page_div', array(
                    "page" => $section
                ));
            }
            else
            {
                $preset = \App\PresetSections::where("id", $section->id_preset_section )->first();
                $sectionHTML .= view("sections/preset_div", array(
                    "id_page" => $id_page,
                    "page" => $preset
                ));
            }
        }

        $img = ( file_exists( $page->image ) ) ? 1 : 0;

        $this->cont->body = view('pages/detail', array(
            "page" => $page,
            "sections" => $sectionHTML,
            "image" => $img          
        ));
        return $this->RenderView();
    }

    protected function editHomePage()
    {
        $sectionHTML = "";
        $this->pageTitle = "Edit page";
        $this->iconClass = "fas fa-sticky-note";
        $this->botonera = view('pages/editbuttons');
        $id = $_REQUEST['id'];

        $page = \App\Pages::where('id', $id)->where("id_company", $this->user->id_company)->first();
        $sections = $page->getSections();
        foreach ( $sections as $section )
        {
            if ( is_null( $section->id_preset_section ) )
            {
                $sectionHTML .= view('sections/page_div', array(
                    "page" => $section
                ));
            }
            else
            {
                $preset = \App\PresetSections::where("id", $section->id_preset_section )->first();
                $sectionHTML .= view("sections/preset_div", array(
                    "page" => $preset
                ));
            }
        }

        $img = ( file_exists( $page->image ) ) ? 1 : 0;

        $this->cont->body = view('pages/detail', array(
            "page" => $page,
            "sections" => $sectionHTML,
            "image" => $img          
        ));
        return $this->RenderView();
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'];
        $page = \App\Pages::where('id', $id)->first();
        $page->menu_title = $_REQUEST['name'];
        $page->save();
        return "OK";
    }

    public function saveAction()
    {
        $page = \App\Pages::where('id', $_REQUEST['id'])->first();
        $page->update($_REQUEST);
        return \Redirect::to('Pages')->send();
    }

    public function removeImageAction()
    {
        $id = $_REQUEST['id'];
        $page = \App\Pages::where('id', $id)->first();

        unlink( $page->image );
        $page->image = null;
        $page->save();
        return view('pages/uploadImage', array(
            "page" => $page
        ));
    }
    public function uploadImageAction()
    {
        if (!empty($_FILES)) {
            
            /**
             * Save file
             */
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];
            $targetDir = "img/hero-slider/$id/";
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
            $page = \App\Pages::where('id', $id)->first();            
            $page->image = $targetFile;
            $page->save();
        }

        return "OK";
    }

    public function addPresetSectionAction()
    {
        $id_preset = $_REQUEST["id_preset_section"];
        $id_page = $_REQUEST["id_page"];
        $page = \App\Pages::where("id", $id_page)->first();
        $presetPage = \App\PresetSectionsPages::create($_REQUEST);
        $presetPage->order = count( $page->getSections() );
        $presetPage->save();
        $preset = \App\PresetSections::where("id", $id_preset)->first();
        return view("sections/preset_div", array(
            "id_page" => $id_page,
            "page" => $preset
        ));
    }

}