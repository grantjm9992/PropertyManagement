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
        $pages = \App\Pages::where('id', '>', 0)->orderBy('order')->get();
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
    }

    public function itemAction()
    {
        $sectionHTML = "";
        $this->pageTitle = "Edit page";
        $this->iconClass = "fas fa-sticky-note";
        $this->botonera = view('pages/editbuttons');
        $id = $_REQUEST['id'];
        $page = \App\Pages::where('id', $id)->first();
        $sections = $page->getSections();
        foreach ( $sections as $section )
        {
            $sectionHTML .= view('sections/page_div', array(
                "page" => $section
            ));
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

}