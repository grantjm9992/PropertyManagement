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
        $id_company = env('ID_COMPANY');
        $company = \App\Companies::where("id", $id_company)->first();
        if( !is_object( $company ) ) die();
        $coordinates = json_decode($company->google_coordinates);

        $this->cont->body = view("contact/index", array(
            "company" => $company,
            "long" => (is_object($coordinates)) ? $coordinates->long : "",
            "lat" => (is_objecT($coordinates)) ? $coordinates->lat : ""
        ));
        return $this->RenderView();
    }
}