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

}