<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class ResortController extends BaseController
{

    public function __construct() {
        $page = \App\Pages::where('id', 1)->first();
        if ( (int)$page->active !== 1 ) return \Redirect::to(url('/'));
        parent::__construct();
    }
    
    public function defaultAction() {
        $page = \App\Pages::where('id',3 )->first();
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

    public function uploadLocalAttractionsAction() 
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];

            $targetDir = "img/resorts/$id/";
            if (!is_dir( $targetDir ) )
            {
                mkdir( $targetDir, 0777, true );
            }
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            move_uploaded_file($tempFile , $image->path);
        }
        return "OK";
    }

    public function downloadLocalAttractionsAction() 
    {
        $id = $_REQUEST["id"];
        $resort = \App\Resorts::where("id", $id)->first();
        header('Content-Disposition: attachment; filename;"local_attraction_information_'.$resort->name.'.json";');
        if ( file_exists( "data/resorts/$id/localattractions.json" ) )
        {
            $csv = "";
            $file = \file_get_contents("data/resorts/$id/localattractions.json");
            die($file);
        }

    }

}