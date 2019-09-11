<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use \App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Support\Facades\DB;
use \App\Providers\TranslationProvider;

use \App\LogOperaciones;
use \App\Messages;

class AdministrationController extends BaseController
{
    public function __construct() {
        if ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) $this->user = \UserLogic::getUser();
        parent::__construct();
    }

    protected function setHeaderAndFooter()
    {
        $this->cont->footer = view('layout/footer_admin');
        $this->cont->header = view('layout/header_admin2', array( "user" => $this->user ) );
    }
    
    protected function RenderView() {
        $_SESSION['errors'] = "";
        if ( !isset( $_SESSION['id'] ) || $_SESSION['id'] == "" ) \Redirect::to('Login')->send();
        $template =  "layout/app_admin";
        return view($template, array(
            'bodyClass' => $this->bodyClass,
            'title' => $this->title,
            'errors' => $this->errors,
            'header' => $this->cont->header,
            'footer' => $this->cont->footer,
            'content' => $this->cont->body,
            "iconClass" => $this->iconClass,
            "titulo" => $this->pageTitle,
            "botonera" => $this->botonera,
            "keywords" => $this->keywords,
            "description" => $this->description
        ));
    }

}
