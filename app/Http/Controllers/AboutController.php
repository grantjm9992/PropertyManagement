<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AboutController extends BaseController
{

    public function __construct() {
        
        parent::__construct();
    }
    
    public function defaultAction() {
        $page = \App\Pages::where("id_company", env('ID_COMPANY'))->where("url", "About")->first();
        $this->title = ( $page->meta_title != "" ) ? $page->meta_title : $this->title;
        $this->description = ( $page->meta_description != "" ) ? $page->meta_description : $this->description;
        $this->keywords = ( $page->meta_keywords != "" ) ? $page->meta_keywords : $this->keywords;
        $data = \App\Sections::where('id_page', $page->id)->get();
        
        $this->cont->body = view("about/index");
        return $this->RenderView();
    }

}