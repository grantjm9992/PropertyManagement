<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;


class ContactController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function defaultAction() {
        $id_company = \AppConfig::id_company;
        $company = \App\Companies::where("id", $id_company)->first();
        if( !is_object( $company ) ) die();

        $this->cont->body = view("contact/index", array(
            "company" => $company
        ));
        return $this->RenderView();
    }
}