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

    public $returnURL;
    public function __construct() {
        if ( !isset( $_SESSION["id"] ) ) die( \Redirect::to("Login")->send() );
        $this->user = \App\User::where('id', $_SESSION["id"])->first();
        parent::__construct();
    }

    protected function setHeaderAndFooter()
    {
        $types = \App\TaskType::where("menu", "1")->get();
        $notifications = \App\Notifications::getUnseenForUser();
        $count = ( is_null( $notifications ) ) ? 0 : count( $notifications );

        $this->cont->footer = view('layout/footer_admin', array(
            "user" => $this->user
        ));
        $this->cont->sidebar = view("layout/admin_sidebar", array(
            "types" => $types,
            "user" => $this->user
        ));
        $back = ( isset( $_SERVER["HTTP_REFERER"] ) ) ? $_SERVER["HTTP_REFERER"] : url("/Admin");
        $back = $this->returnURL != "" ? $this->returnURL : $back;
        $this->cont->header = view('layout/admin_header', array(
            "notifications" => $notifications,
            "count_notifications" => $count,
            "back" => $back,
            "user" => $this->user
        ));
    }
    
    protected function RenderView() {
        $this->setHeaderAndFooter();
        $_SESSION['errors'] = "";
        $template =  "layout/app_admin";
        return view($template, array(
            "sidebar" => $this->cont->sidebar,
            "navbar" => $this->cont->header,
            "content" => $this->cont->body,
            "footer" => $this->cont->footer,
            "pageTitle" => $this->pageTitle,
            "iconClass" => $this->iconClass,
            "botonera" => $this->botonera
        ));
    }

}
