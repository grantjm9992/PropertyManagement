<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PropertyManagementController extends BaseController
{

    public function __construct() {
        
        parent::__construct();
    }
    
    public function defaultAction() {
        $page = \App\Pages::where("id_company", env('ID_COMPANY'))->where("url", "PropertyManagement")->first();
        $this->title = ( $page->meta_title != "" ) ? $page->meta_title : $this->title;
        $this->description = ( $page->meta_description != "" ) ? $page->meta_description : $this->description;
        $this->keywords = ( $page->meta_keywords != "" ) ? $page->meta_keywords : $this->keywords;
        $sections = $page->getSections();

        $sectionHTML = "";
        foreach ( $sections as $row )
        {
            if ( !is_null( $row->id_preset_section ) )
            {
                $section = \App\PresetSections::where( "id", $row->id_preset_section )->first();
                $function = "$section->function";
                $sectionHTML .= \App\Classes\PresetSectionProvider::$function();
            }
            else
            {
                $sectionHTML .= $row->description;
            }
        }
        $this->cont->body = view("property/index", array(
            "sections" => $sectionHTML
        ));
        return $this->RenderView();
    }

}